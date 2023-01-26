<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $users = [];
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        } else{
            $page = 1;
        }
        // for ($i = 1; $i < 53; $i++){
        //     $users[] = [
        //         'id' => $i,
        //         'name' => "name$i",
        //         'email' => "email$i@gmail.com",
        //         'phone' => 123456789,
        //         'type' => "type$i",
        //         'status' => $i % 2 == 0
        //     ];
        // }

        $db = new \DatabaseConnection();
        $users = $db->getEntries($page);
        $user_n = count($users);
        $page_n = $db->getPages();

        return $this->render('default/index.html.twig', 
        [
            'users' => $users, 
            'user_n' => $user_n, 
            'page' => $page,
            'page_n' => $page_n
        ]
    );
    }
}
