<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\Structure;
use App\Entity\UniteBien;
use App\Form\BienType;
use App\Form\SelectionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use FOS\RestBundle\Controller\Annotations as Rest;

class InventaireController extends AbstractController
{
    #private $entityManager;
    #private $serializer;
    public function __construct(EntityManagerInterface $entityManager) #, SerializerInterface $serializer
    {
        $this->entityManager = $entityManager;
        #$this->serializer = $serializer;
    }
    /**
     * @Route("/inventaire", name="app_inventaire")
     */
    public function index(Request $request): Response
    {
        return $this->render('inventaire/index.html.twig');
    }



    /**
     * @Route("/inventaire/selection", name="app_inventaire_selection")
     */
    public function selection(Request $request): Response
    {
        $form = $this->createForm(SelectionType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $selection = $form->getData();
            $structure = $form->get('Structure')->getData();
            $service = $form->get('Service')->getData();
            return $this->redirect($this->generateUrl('app_inventaire_restful', array(
                'structure' => $structure,
                'service' => $service,
            )
            ));
        }
        return $this->render('inventaire/selection.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/inventaire/type/restful", name="app_inventaire_restful")
     * 
    */
    public function restful(Request $request): Response 
    {
        $structure= $_GET['structure'];
        $service= $_GET['service'];
        $biens = $this->entityManager->getRepository(Bien::class)->findAll($service);
        $array=array();
        foreach ($biens as &$value) {
            $unites=$value->getUniteBiens();
            foreach ($unites as &$unite) {
                array_push($array,$unite);
            }
            #dd($array[4]);
        }

        /*
        $str = $this->entityManager->getRepository(Structure::class)->findAll();

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $serializer = new Serializer([$normalizer]);

        $data = $serializer->normalize($str, null, ['groups' => 'api']);
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        #
        */
        return $this->render('inventaire/type/restful.html.twig',
        ['array'=>$array,
        'structure' => $structure,
        'service' => $service,]);
    }


}