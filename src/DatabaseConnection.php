<?php

uuse App\Repository\EntryRepository;
use Doctrine\ORM\EntityManagerInterface;

class DatabaseConnection
{
    private $entryRepository;
    private $entityManager;

    public function __construct(EntryRepository $entryRepository, EntityManagerInterface $entityManager)
    {
        $this->entryRepository = $entryRepository;
        $this->entityManager = $entityManager;
    }

    public function getEntries($page)
    {
        return $this->entryRepository->findBy([], ['id' => 'ASC'], 10, ($page - 1) * 10);
    }
}

public function getPages()
{
    $entryCount = $this->entryRepository->count([]);
    return ceil($entryCount / 10);
}

public function getEntry($id)
{
    return $this->entryRepository->find($id);
}

public function addEntry(Entry $entry)
{
    $this->entityManager->persist($entry);
    $this->entityManager->flush();
}

public function updateEntry($id, Entry $entry)
{
    $this->entityManager->flush();
}

public function deleteEntry($id)
{
    $entry = $this->entryRepository->find($id);
    $this->entityManager->remove($entry);
    $this->Entitymanager->flush();
}
}
