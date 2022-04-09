<?php

namespace App\Controller;

use App\Form\ServiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service", name="app_service")
     */
    public function index(Request $request): Response
    {
        $notification = null;
        $form = $this->createForm(ServiceType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service = $form->getData();
            $this->entityManager->persist($service);
            $this->entityManager->flush();
            $notification = 'Service ajouté correctement';
        

        }
        return $this->render('service/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
