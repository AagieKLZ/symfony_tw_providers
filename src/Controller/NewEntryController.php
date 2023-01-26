<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;

class NewEntryController extends AbstractController
{
    public function createNewForm(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class, ['label' => 'Nombre'])
            ->add('email', EmailType::class, ['label' => 'Correo Electrónico'])
            ->add('tlf', TelType::class, ['label' => 'Teléfono'])
            ->add('type', ChoiceType::class, ['choices' => ['Hotel' => 'Hotel', 'Pista' => 'Pista', 'Complemento' => 'Complemento'], 'label' => 'Categoría'])
            ->add('active', CheckboxType::class, ['label' => 'Proveedor activo'])
            ->add('submit', SubmitType::class, ['label' => 'Añadir'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // do something with the data
            $data = $form->getData();
            // ...
        }

        return $this->render('default/new.html.twig', ['form' => $form->createView()]);
    }
}
