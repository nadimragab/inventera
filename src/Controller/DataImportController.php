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
            $j=747;
            while(($line=\fgetcsv($csv, 410, ";"))!==false)
            {
                $j=$j+1;
                $bien = new Bien();
                $identifier="BI-2022-".$j.rand(100,999);
                $bien->setId($identifier);
                $bien->setReferenceBien($identifier);
                $bien->setSlug($identifier);

                $structure=$this->entityManager->getRepository(Structure::class)->findOneBy(['id' =>1]);
                $bien->setStructure($structure);
                $service = $this->entityManager->getRepository(Service::class)->findOneBy(['id' =>2]);
                $bien->setService($service);

                $bien->setNom($line[2]);
                $date= date_create($line[3]);
                $bien->setDateAcquisition($date);
                $bien->setValeurAcquisition(floatval(str_replace(' ', '', $line[4])));
                $bien->setDureeAmortissement((int) $line[5]);
                $bien->setNombreUniteLot((int) $line[6]);
                $bien->setCompteActif((int) $line[7]);
                $bien->setCompteAmortissement((int) $line[8]);
                $bien->setCompteDotation((int) $line[9]);
                $this->entityManager->persist($bien);
                $this->entityManager->flush();
                for ($i = 0; $i < (int) $line[6]; $i++) {
                    $refUnite = $identifier . "-" . (string) $i;
                    $unite = new UniteBien();
                    $unite->setId($refUnite);
                    $unite->setRefBien($bien);
                    $unite->setNbrInv(0);
                    $unite->setEtatPhy("en amortissement");
                    $unite->setNumUnite($i);
                    $unite->setRefUnite($refUnite);
                    $unite->setStructureAtt($structure);
                    $unite->setServiceAtt($service);
                    $this->entityManager->persist($unite);
                    $this->entityManager->flush();
    
                }
                
            }
            
            fclose($csv);
        }
    
        return $this->render('files/import/csvdata.html.twig');
    }

}