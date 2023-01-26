<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewEntryController extends AbstractController
{
    /**
     * @Route('/new', name='new_entry')
     */
    public function newEntry()
    {

        return $this->render('default/new.html.twig');
    }
}