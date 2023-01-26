<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditorController extends AbstractController
{
    /**
     * @Route('/edit', name='edit_entry')
     */
    public function editEntry()
    {
        return $this->render('default/edit.html.twig');
    }
}