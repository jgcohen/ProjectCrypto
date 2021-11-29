<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct (EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request, UserPasswordHasherInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class,$user);

        $form->handleRequest($request);

        $notification = "";
        if($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();


            $password = $encoder->hashPassword($user,$user->getPassword());
            
                $user->setPassword($password);
               
                $search_email = $this->entityManager->getRepository(User::class)->findOneBy(array('email'=>$user->getEmail()));
               if(!$search_email){
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $notification = "Inscription effectuée";
               }else{
                $notification = "Adresse E-mail déja utilisée"; 
               }
                
            

        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'notification'=> $notification
        ]);
    }
}
