<?php

namespace App\Controller;

use DateTime;
use App\Entity\Inventaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{


    /* ______________________________________Constructeur______________________________________________________*/
    public function __construct(EntityManagerInterface $entityManager) #, SerializerInterface $serializer
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/account", name="app_account")
     */
    public function index(): Response
    {
        $inventaire = new Inventaire();
        $year = (int) date("Y");
        $dateDebut = new DateTime();
        $inventaire->setDateDebut($dateDebut);
        $inventaire->setYear($year);
        //$inventaire->setDateDebut($dateDebut);

        $invCour = $this->entityManager->getRepository(Inventaire::class)->findOneBy(['year' => $year]);;
        if ($invCour == null) {
            $this->entityManager->persist($inventaire);
            $this->entityManager->flush();
        }


        return $this->render('account/index.html.twig');
    }
}
