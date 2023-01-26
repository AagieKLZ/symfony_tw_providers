<?php

use Symfony\Component\Dotenv\Dotenv;
use mysqli;
use App\Entity\Entry;

class DatabaseConnection
{
    private $connection;

    public function __construct()
    {
        (new Dotenv())->load(__DIR__.'/../.env');
        $host = $_ENV['DATABASE_HOST'];
        $username = $_ENV['DATABASE_USER'];
        $password = $_ENV['DATABASE_PASSWORD'];
        $dbname = $_ENV['DATABASE_NAME'];

        $this->connection = new mysqli($host, $username, $password, $dbname);

        if ($this->connection->connect_error) {
            throw new Exception("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getEntries($page)
    {
        $sql = "SELECT * FROM Providers LIMIT 10 OFFSET ".(($page - 1) * 10);
        $result = $this->connection->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getPages()
    {
        #Get number of entries
        $sql = "SELECT COUNT(*) FROM Providers";
        $result = $this->connection->query($sql);
        $n = mysqli_fetch_assoc($result)["COUNT(*)"];
        return ceil($n / 10);
    }

    public function getEntry($id)
    {
        $sql = "SELECT * FROM Providers WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return mysqli_fetch_assoc($result);
    }

    public function addEntry(Entry $entry)
    {
        $name = $entry->getName();
        $email = $entry->getEmail();
        $tlf = $entry->getTlf();
        $cat = $entry->getCat();
        $active = $entry->getActive() ? 1 : 0;
        $sql = "INSERT INTO Providers (name, email, tlf, cat, is_active, created_at, last_modified) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssisi", $name, $email, $tlf, $cat, $active);
        $stmt->execute();
    }

    public function updateEntry($id, $data)
    {
        $sql = "UPDATE Providers SET name = ?, email = ?, tlf = ?, cat = ?, is_active = ?, last_modified = NOW() WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $is_active = $data["active"] ? 1 : 0;
        $stmt->bind_param("sssssi", $data["name"], $data["email"], $data["tlf"], $data["type"], $is_active, $id);
        $stmt->execute();
    }

    public function deleteEntry($id)
    {
        $sql = "DELETE FROM Providers WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
