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

        // try {
        $db = new \DatabaseConnection();
        $users = $db->getEntries($page);
        $page_n = $db->getPages();
        // } catch (\Throwable $th) {
        //     return $this->render('default/db_error.html.twig');
        // } TODO: Fix this after
        
        $user_n = count($users);
        
        if (isset($_GET['action']) && isset($_GET['success'])){
            $action = $_GET['action'];
            $success = $_GET['success'];
        } else{
            $action = "None";
            $success = False;
        }
        return $this->render('default/index.html.twig', 
        [
            'users' => $users, 
            'user_n' => $user_n, 
            'page' => $page,
            'page_n' => $page_n,
            'action' => $action,
            'success' => $success
        ]
    );
    }
}
