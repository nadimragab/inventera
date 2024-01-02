<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienqrType;
use App\Entity\UniteBien;
use Endroid\QrCode\QrCode;
use Doctrine\ORM\Mapping\Id;
use App\Service\QrcodeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\SelectionType;

class MassivePrintController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/impression/", name="app_impmass_services")
     */
    public function selectService(Request $request)
    {
        $form = $this->createForm(SelectionType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $selection = $form->getData();
            $structure = $form->get('Structure')->getData();
            $service = $form->get('Service')->getData();
            $service_id = $service->getId();
            return $this->redirect($this->generateUrl(
                'app_impmass_service',
                array(
                    'service_id' => $service_id
                )
            ));
        }
        return $this->render('impression/serviceselector.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/impression/{service_id}", name="app_impmass_service")
     */
    public function serviceMassivePrint(Request $request, QrcodeService $qrcodeService, $service_id)
    {
        $bienArray = $this->entityManager->getRepository(UniteBien::class)->findBy(["serviceAtt" => $service_id]);
        #dd($bienArray);
        #_______________________QR code generation code______________________________________________
        #dd($bienArray);
        $qrCode = null;
        #$qrArray = $bien->getUniteBiens();
        $qrs = array();
        #____________________________________________________________________________________________
        #count($bienArray)
        #for ($i = 0; $i < count($bienArray); $i++) {
        for ($i = 0; $i < count($bienArray); $i++) {
            #dd(count($bienArray));
            #for ($i = 0; $i < 100; $i++) {
            $qrCode = $qrcodeService->qrcode($bienArray[$i]->getRefUnite());
            array_push($qrs, $qrCode);
        }
        #$qrCode = $qrcodeService->qrcode($bien->getReferenceBien());
        return $this->render('impression/impressionservice.html.twig', [
            'bien' => $bienArray,
            'qrCode' => $qrs
        ]);
    }
}
