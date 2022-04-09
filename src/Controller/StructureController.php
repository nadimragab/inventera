<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\StructureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StructureController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/structure", name="app_structure")
     */
    public function index(Request $request): Response
    {
        $notification = null;
        $form = $this->createForm(StructureType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $structure = $form->getData();
            $this->entityManager->persist($structure);
            $this->entityManager->flush();
            $notification = 'Structure ajoutée correctement';
        

        }
        return $this->render('structure/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
