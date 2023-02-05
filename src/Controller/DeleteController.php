<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Entry;

class DeleteController extends AbstractController
{
        /**
        * @Route("/delete/{id}", name="delete")
        */
        public function deleteEntry(int $id)
        {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(Entry::class)->find($id);
            if ($user){
                $entityManager->getRepository(Entry::class)->deleteEntry($user);
                return $this->redirect('/?action=delete&success=true');
            } else{
                return $this->render('default/edit_error.html.twig');
            }
    }
}