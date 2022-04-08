<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }



    /**
     * @Route("/account/password", name="app_account_password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($encoder->isPasswordValid($user, $form->get('old_password')->getData())) {

                $user->setPassword(
                    $encoder->encodePassword(
                        $user,
                        $form->get('new_password')->getData()
                    )
                );
                // $this->entityManager->persist($user); //n'est pas utile pour une MàJ
                $this->entityManager->flush();
                $notification = "Votre mot de passe a bien été mis à jour !";
            } else {
                $notification = "Votre mot de passe actuel n'est pas le bon";
            }
        }
        return $this->render('account/password.html.twig', [

            'form' => $form->createView(),
            'notification' =>  $notification
        ]);

    }
}
