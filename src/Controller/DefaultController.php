<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Entry;

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
        
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(Entry::class)->getEntries($page);
        $page_n = $entityManager->getRepository(Entry::class)->getPages();
        
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
