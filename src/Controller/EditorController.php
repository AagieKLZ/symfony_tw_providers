<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;

class EditorController extends AbstractController
{
    /*
     * @Route('/edit', name='edit_entry')
     */
    public function editEntry(Request $request)
    {
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
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            // $filtered = array_filter($users, [$this, 'filter_results']);
            $db = new \DatabaseConnection();
            $user = $db->getEntry($id);

            if ($user){
                $form = $this->createFormBuilder()
                    ->add('name', TextType::class, ['label' => 'Nombre', 'data' => $user['name']])
                    ->add('email', EmailType::class, ['label' => 'Correo Electrónico', 'data' => $user['email']])
                    ->add('tlf', TelType::class, ['label' => 'Teléfono', 'data' => $user['tlf']])
                    ->add('type', ChoiceType::class, ['choices' => ['Hotel' => 'Hotel', 'Pista' => 'Pista', 'Complemento' => 'Complemento'], 'label' => 'Categoría', 'data' => $user["cat"]])
                    ->add('active', CheckboxType::class, ['label' => 'Proveedor activo', 'data' => $user["is_active"] == 1, 'required' => false])
                    ->add('submit', SubmitType::class, ['label' => 'Añadir'])
                    ->getForm();
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    // do something with the data
                    $data = $form->getData();
                    $db->updateEntry($id, $data);
                    return $this->redirectToRoute('homepage');
                }
                return $this->render('default/edit.html.twig', ['id' => $id, 'user' => $user, 'form' => $form->createView()]);
            }
            return $this->render('default/edit_error.html.twig');     
            
        }
        $id = 1;
        return $this->render('default/edit_error.html.twig'); 
    }
    public function filter_results($var){
        return ($var['id'] == $_GET['id']);
    }
}