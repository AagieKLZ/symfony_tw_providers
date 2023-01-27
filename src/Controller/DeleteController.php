<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
        /**
        * @Route("/delete", name="delete")
        */
        public function deleteEntry()
        {
        try {
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $db = new \DatabaseConnection();
                if ($db->getEntry($id)){
                    $db->deleteEntry($id);
                    return $this->redirect('/?action=delete&success=true');
                } else{
                    return $this->render('default/edit_error.html.twig');
                }
                
            }
        } catch (\Throwable $th) {
            return $this->render('default/db_error.html.twig');
        }
        return $this->render('default/edit_error.html.twig');
    }
}