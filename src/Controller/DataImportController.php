<?php

namespace App\Controller;

use DateTime;
use App\Entity\Bien;
use App\Entity\Service;
use App\Form\BienqrType;
use App\Entity\Structure;
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

class DataImportController extends AbstractController
{

     /* ______________________________________Constructeur______________________________________________________*/
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
     * @Route("/file/import/csv", name="file_import_csv")
     */
    public function openCSV(): Response
    {

        return $this->render('files/import/csv.html.twig');
    }

    /**
     * @Route("/file/import/csv/data", name="file_import_csv_data")
     */
    public function importCSV(): Response
    {
        $file=$_FILES["csv-file"];
        $path= $_FILES["csv-file"]["tmp_name"];
        if($path!="")
        {
            $csv = fopen($path, "r");
            $array= array();
            $bien = new Bien();
            $cmp=0;
            while(($line=\fgetcsv($csv, 1000, ";"))!==false)
            {
                $bien->setId($line[0]);
                $bien->setReferenceBien($line[0]);
                $bien->setSlug($line[0]);
                $structure = $this->entityManager->getRepository(Structure::class)->findOneBy(['nomStructure' =>$line[1]] );
                $service = $this->entityManager->getRepository(Service::class)->findOneBy(['nomService' =>$line[2]] );
                $bien->setStructure($structure);
                $bien->setService($service);
                $bien->setNom($line[3]);
                $date= date_create($line[4]);
                $bien->setDateAcquisition($date);
                $bien->setValeurAcquisition((int) $line[5]);
                $bien->setDureeAmortissement((int) $line[6]);
                $bien->setNombreUniteLot((int) $line[7]);
                $bien->setCompteActif((int) $line[8]);
                $bien->setCompteAmortissement((int) $line[9]);
                $bien->setCompteDotation((int) $line[10]);
                $this->entityManager->persist($bien);
                for ($i = 0; $i < (int) $line[7]; $i++) {
                    $refUnite = $line[0] . "-" . (string) $i;
                    #dd($refUnite);
                    $unite = new UniteBien();
                    $unite->setId($refUnite);
                    $unite->setRefBien($bien);
                    $unite->setNbrInv(0);
                    $unite->setEtatPhy("en amortissement");
                    $unite->setNumUnite($i);
                    $unite->setRefUnite($refUnite);
                    $unite->setStructureAtt($structure);
                    $unite->setServiceAtt($service);
                    //dd($unite);
                    $this->entityManager->persist($unite);

    
                }
               $this->entityManager->flush();
            }
            fclose($csv);
        }
    
        return $this->render('files/import/csvdata.html.twig');
    }

}