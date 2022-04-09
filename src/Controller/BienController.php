<?php

namespace App\Controller;

use App\Form\BienType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BienController extends AbstractController
{
    /**
     * @Route("/bien", name="app_bien")
     */
    public function index(Request $request): Response
    {
        $notification = null;
        $form = $this->createForm(BienType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bien = $form->getData();
            $this->entityManager->persist($bien);
            $this->entityManager->flush();
            $notification = 'Bien ajouté correctement';
        

        }
        return $this->render('Bien/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
