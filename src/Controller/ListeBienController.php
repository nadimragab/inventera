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

        #___________________test________________________
        foreach ($biens as $bien) {
            $bien->setEtatAmortissement();
            #$bien->setCodeInvNat("000");
            $this->entityManager->flush();
        }

        #_______________________________________________
        $biens = $this->entityManager->getRepository(Bien::class)->findAll();

        return $this->render('liste_bien/index.html.twig', [

            'biens' => $biens
        ]);
    }

    /**
     * @Route("/bien/{slug}", name="app_show_bien")
     */
    public function show(Request $request, $slug)
    {
        $bien = $this->entityManager->getRepository(Bien::class)->findOneBySlug($slug);
        if (!$bien) {
            return $this->redirectToRoute('app_liste_bien');
        }

        return $this->render('bien/show.html.twig', [
            'bien' => $bien
        ]);
    }

    /**
     * @Route("/bien/{slug}/qr", name="app_qr_bien")
     */
    public function qrcode(Request $request, $slug, QrcodeService $qrcodeService)
    {
        $bien = $this->entityManager->getRepository(Bien::class)->findOneBySlug($slug);
        #_______________________QR code generation code______________________________________________

        $qrCode = null;
        $qrArray = $bien->getUniteBiens();
        $qrs = array();
        #____________________________________________________________________________________________
        if (!$bien) {
            return $this->redirectToRoute('app_liste_bien');
        }
        for ($i = 0; $i < $qrArray->count(); $i++) {
            $qrCode = $qrcodeService->qrcode($qrArray[$i]->getRefUnite());
            array_push($qrs, $qrCode);
        }
        $qrCode = $qrcodeService->qrcode($bien->getReferenceBien());
        return $this->render('bien/qrcode.html.twig', [
            'bien' => $bien,
            'qrCode' => $qrs
        ]);
    }

    /**
     * @Route("/impmassive", name="app_qrs_impression")
     */
    public function qrs(Request $request, QrcodeService $qrcodeService)
    {
        $bienArray = $this->entityManager->getRepository(UniteBien::class)->findBy(["structureAtt" => "2"]);;
        #_______________________QR code generation code______________________________________________
        #dd($bienArray);
        $qrCode = null;
        #$qrArray = $bien->getUniteBiens();
        $qrs = array();
        #____________________________________________________________________________________________
        #count($bienArray)
        
        for ($i = 0; $i < 100; $i++) {
        #for ($i = 0; $i < 10; $i++) {
            $qrCode = $qrcodeService->qrcode($bienArray[$i]->getRefUnite());
            array_push($qrs, $qrCode);
        }
        #$qrCode = $qrcodeService->qrcode($bien->getReferenceBien());
        return $this->render('bien/qrs.html.twig', [
            'bien' => $bienArray,
            'qrCode' => $qrs
        ]);
    }
}
