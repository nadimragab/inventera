<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienType;
use App\Entity\Service;
use App\Entity\Structure;
use App\Entity\UniteBien;
use App\Form\SelectionType;
use App\Form\InventaireRestType;
use Gedmo\Sluggable\Util\Urlizer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Annotations\AnnotationReader;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;

class TraitementController extends AbstractController
{
    /* ______________________________________Constructeur______________________________________________________*/
    public function __construct(EntityManagerInterface $entityManager) #, SerializerInterface $serializer
    {
        $this->entityManager = $entityManager;
    }



    /* _________________________________traitement post-inventaire par service____________________________________*/
    /**
     * @Route("/inventaire/traitement", name="app_traitement")
     * 
     */
    public function traitementGeneral(): Response
    {
        $nbr_liste = 0;
        $regles = [];
        $excedants = [];
        $manquants = [];
        if (isset($_POST['regles'])) {
            $regles = $_POST['regles'];
            $nbr_liste++;
        }
        if (isset($_POST['excedants'])) {
            $excedants = $_POST['excedants'];
            $nbr_liste++;
        }
        if (isset($_POST['manquants'])) {
            $manquants = $_POST['manquants'];
            $nbr_liste++;
        }

        return $this->render('/inventaire/traitement.html.twig', ['regles' => $regles, 'excedants' => $excedants, 'manquants' => $manquants]);
    }
}
