<?php

namespace App\Controller;

use App\Entity\Bien;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListeBienController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @Route("/les-biens", name="app_liste_bien")
     */
    public function index(): Response
    {


        $biens = $this->entityManager->getRepository(Bien::class)->findAll();



        return $this->render('liste_bien/index.html.twig', [

            'biens' => $biens 
        ]);
    }

    /**
     * @Route("/bien/{slug}", name="app_show_bien")
     */
    public function show($slug)
    {
        $bien = $this->entityManager->getRepository(Bien::class)->findOneBySlug($slug);
        if (!$bien) {
            return $this->redirectToRoute('app_liste_bien');
        }
        return $this->render('bien/show.html.twig', [
            'bien' => $bien
        ]);
    }
}
