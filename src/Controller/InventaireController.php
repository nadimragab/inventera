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
        $form = $this->createForm(InventaireRestType::class);
        $form->handleRequest($request);
        $structure= $_GET['structure'];
        $serviceURL= $_GET['service'];
        $service=$this->entityManager->getRepository(Service::class)->findOneBy(['nomService' => $serviceURL]);
        $array=$service->getUniteBiens();
        /*
        $biens = $this->entityManager->getRepository(Bien::class)->findAll($service);
        $array=array();
        foreach ($biens as &$value) {
            $unites=$value->getUniteBiens();
            foreach ($unites as &$unite) {
                array_push($array,$unite);
                //array est la liste des biens.
            }

        }*/
        #$str = $this->entityManager->getRepository(Structure::class)->findAll();
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getName();
            },
        ];
        $serializer = new Serializer([$normalizer]);
        #$data = $serializer->normalize($str, null, ['groups' => 'api']);
        $data = $serializer->normalize($array, null, ['groups' => 'api']);
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        #return $response;
        $ipAd=$_SERVER['HTTP_HOST']; 
        return $this->render('inventaire/type/restful.html.twig',
        ['array'=>$array,
        'structure' => $structure,
        'service' => $service,
        'json'=>$response,
        'ip'=>$ipAd,
        'form' => $form->createView(),
        'length'=>count($array)]
        );

 
    }

    /**
     * @Route("/api/unites/{ref}", name="app_api_uniteBien")
     * 
    */
    public function api(string $ref): Response 
    {

        $unite = $this->entityManager->getRepository(UniteBien::class)->findOneBy(['refUnite'=>(string)$ref]);

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getName();
            },
        ];
        $serializer = new Serializer([$normalizer]);
        $data = $serializer->normalize($unite, null, ['groups' => 'api']);
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/inventaire/traitement/", name="app_traitementGeneral")
     * 
    */
    public function traitementGeneral(): Response 
    {
        return $this->render('inventaire/traitement.html.twig');
    }




    /**
     * @Route("/inventaire/traitement/{structure}/{service}", name="app_traitement")
     * 
    */
    public function traitement(string $structure, string $service): Response 
    {
        $service=str_replace('-',' ', $service);

        $service=$this->entityManager->getRepository(Service::class)->findOneBy(['nomService' => $service]);
        $array=$service->getUniteBiens();
        #$str = $this->entityManager->getRepository(Structure::class)->findAll();
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getName();
            },
        ];
        $serializer = new Serializer([$normalizer]);
        #$data = $serializer->normalize($str, null, ['groups' => 'api']);
        $data = $serializer->normalize($array, null, ['groups' => 'api']);
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        #return $response;
        $ipAd=$_SERVER['HTTP_HOST']; 
        return $response;
    }

}