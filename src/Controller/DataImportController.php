<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienqrType;
use Endroid\QrCode\QrCode;
use App\Service\QrcodeService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DataImportController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/file/import/", name="file_import")
     */
    public function import(): Response
    {

        return $this->render('files/import/import.html.twig');
    }

    /**
     * @Route("/file/import/openCSV", name="file_open_CSV")
     */
    public function openCSV(): Response
    {

        return $this->render('files/import/openCSV.html.twig');
    }

    /**
     * @Route("/file/import/importCSV", name="file_import_CSV")
     */
    public function importCSV(): Response
    {
        $file=$_FILES["csv-file"];
        $path= $_FILES["csv-file"]["tmp_name"];
        //dd($file);
        if($path!="")
        {
            $csv = fopen($path, "r");
            //dd($csv);
            $bien=fgetcsv($csv);
            dd($bien);
            fclose($csv);
        }
    
        return $this->render('files/import/importCSV.html.twig');
    }

}