<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class ServiceController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/service", name="app_service")
     */
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $notification = null;
        $form = $this->createForm(ServiceType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service = $form->getData();
            $nomService = $form->get('nomService')->getData();
            $service->setSlug($slugger->slug($nomService));
            $this->entityManager->persist($service);
            $this->entityManager->flush();
            $notification = 'Service ajouté correctement';
            unset($service);
            unset($form);
            $structure = new Service();
            $form = $this->createForm(ServiceType::class);
        }
        return $this->render('service/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
