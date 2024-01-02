<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\UniteBien;
use App\Form\BienType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Gedmo\Sluggable\Util\Urlizer;

class BienController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/bien", name="app_bien")
     */
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $notification = null;
        $form = $this->createForm(BienType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $bien = $form->getData();
            #dd($bien);
            $nomBien = $form->get('nom')->getData();
            $bien->setSlug($slugger->slug($nomBien));
            $referenceBien = "BI-" . date("Y") . "-" . rand(1000000, 9999999);
            while ($this->entityManager->getRepository(Bien::class)->findOneBy(['referenceBien' => $referenceBien]) != null) {
                $referenceBien = "BI-" . date("Y") . "-" . rand(100000, 999999);
            }
            #$referenceBien = $form->get('referenceBien')->getData();
            $bien->setId($referenceBien);
            $bien->setReferenceBien($referenceBien);
            if ($form->get('nombreUniteLot')->getData() == null) {
                $bien->setNombreUniteLot(1);
            }
            if ($form->get('dureeAmortissement')->getData() == null) {
                $bien->setDureeAmortissement(5);
            }
            $bien->setValeurAmortissement();
            $bien->setEtatAmortissement();


            #new code for image upload__________________________________________________
            $uploadedFile = $form['image']->getData();
            $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessExtension();
            $uploadedFile->move(
                $destination,
                $newFilename
            );
            $bien->setImage($newFilename);



            #___________________________________________________________________________
            $this->entityManager->persist($bien);
            #$this->entityManager->flush();



            #----------------Adding instances in Unite table------------------------#

            $nbr = (int)$form->get('nombreUniteLot')->getData();
            $batchSize = 1;
            $ref = $referenceBien;
            #(string)$form->get('referenceBien')->getData();
            $strAtt = $form->get('Structure')->getData();
            $serAtt = $form->get('Service')->getData();
            for ($i = 0; $i < $nbr; $i++) {
                $refUnite = $ref . "-" . (string) $i;
                #dd($refUnite);
                $unite = new UniteBien();
                $unite->setId($refUnite);
                $unite->setRefBien($bien);
                $unite->setNbrInv(0);
                $unite->setEtatPhy("Nouveau");
                $unite->setNumUnite($i);
                $unite->setRefUnite($refUnite);
                $unite->setStructureAtt($strAtt);
                $unite->setServiceAtt($serAtt);
                $this->entityManager->persist($unite);
                #$this->entityManager->flush();

            }
            $notification = 'Bien ajouté correctement';
            #-----------------------------------------------------------------------#
            $this->entityManager->flush();
            unset($bien);
            unset($form);
            $bien = new Bien();
            $form = $this->createForm(BienType::class);
        }

        return $this->render('bien/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
