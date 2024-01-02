<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\StructureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
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
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $notification = null;
        $form = $this->createForm(StructureType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $structure = $form->getData();
            $nomStructure = $form->get('nomStructure')->getData();
            $structure->setSlug($slugger->slug($nomStructure));
            $this->entityManager->persist($structure);
            $this->entityManager->flush();
            $notification = 'Structure ajoutée correctement';
            unset($structure);
            unset($form);
            $structure = new Structure();
            $form = $this->createForm(StructureType::class);
        }
        return $this->render('structure/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
