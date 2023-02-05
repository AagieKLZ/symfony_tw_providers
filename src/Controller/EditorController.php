<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Entry;

class EditorController extends AbstractController
{
    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editEntry(int $id, Request $request)
    {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(Entry::class)->find($id);
            if ($user){
                $form = $this->createFormBuilder($user)
                    ->add('name', TextType::class, ['label' => 'Nombre', 'data' => $user->getName()])
                    ->add('email', EmailType::class, ['label' => 'Correo Electrónico', 'data' => $user->getEmail()])
                    ->add('tlf', TelType::class, ['label' => 'Teléfono', 'data' => $user->getTlf()])
                    ->add('cat', ChoiceType::class, ['choices' => ['Hotel' => 'Hotel', 'Pista' => 'Pista', 'Complemento' => 'Complemento'], 'label' => 'Categoría', 'data' => $user->getCat()])
                    ->add('isActive', CheckboxType::class, ['label' => 'Proveedor activo', 'data' => $user->getIsActive() == 1, 'required' => false])
                    ->add('submit', SubmitType::class, ['label' => 'Guardar'])
                    ->getForm();
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $entityManager->getRepository(Entry::class)->updateEntry($user);
                    return $this->redirect('/?action=create&success=true');
                }
                return $this->render('default/edit.html.twig', ['id' => $id, 'user' => $user, 'form' => $form->createView()]);
            }
            return $this->render('default/edit_error.html.twig');        
    }
}