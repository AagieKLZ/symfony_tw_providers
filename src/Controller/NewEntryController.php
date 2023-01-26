<?php
namespace App\Controller;

use App\Entity\Entry;
use Symfony\Component\Config\Definition\Exception\Exception;
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
use Symfony\Component\Dotenv\Dotenv;
use DatabaseConnection;

class NewEntryController extends AbstractController
{
    private $connection;
    public function createNewForm(Request $request)
    {
        $db = new DatabaseConnection();
        $entry = new Entry();
        $form = $this->createFormBuilder($entry)
            ->add('name', TextType::class, ['label' => 'Nombre', 'invalid_message' => 'El nombre debe tener más de 3 caracteres'])
            ->add('email', EmailType::class, ['label' => 'Correo Electrónico', 'invalid_message' => 'El email debe ser de la forma example@example.com'])
            ->add('tlf', TelType::class, ['label' => 'Teléfono', 'invalid_message' => 'El número de teléfono debe tener 9 dígitos'])
            ->add('cat', ChoiceType::class, ['choices' => ['Hotel' => 'Hotel', 'Pista' => 'Pista', 'Complemento' => 'Complemento'], 'label' => 'Categoría'])
            ->add('active', CheckboxType::class, ['label' => 'Proveedor activo', 'required' => false])
            ->add('submit', SubmitType::class, ['label' => 'Añadir'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $db->addEntry($data);
            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/new.html.twig', ['form' => $form->createView()]);
    }
}
