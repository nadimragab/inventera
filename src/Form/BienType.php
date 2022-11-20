<?php

namespace App\Form;

use App\Entity\Bien;
use App\Entity\Service;
use App\Entity\Structure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('nom',TextType::class, [
                'label'=>'Nom du bien',
                'constraints' => new Length(['min' => 3,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez le nom de votre nouveau bien"]])
            ->add('description',TextType::class, [
                'label'=>'Description',
                'constraints' => new Length(['min' => 8,'max' => 1024]),
                'attr'=>['placeholder'=>"Insérez la description de votre bien"]])
            ->add('referenceBien',TextType::class, [
                'label'=>'Référence du bien',
                'constraints' => new Length(['min' => 3,'max' => 12]),
                'attr'=>['placeholder'=>"Insérez la référence pour le code QR"]])
            
            
            ->add('dateAcquisition',DateType::class, [
                'label'=>'Date acquisition',
                'data' => new \DateTime(),
                'widget' => 'choice',
                'input'  => 'datetime',
                'attr'=>['placeholder'=>"Insérez la date d'acquisition de votre bien"]])
            
            
            ->add('nombreUniteLot',IntegerType::class, [
                'label'=>'Nombre unités',
                'constraints' => new Length(['min' => 1,'max' => 4]),
                'attr'=>['placeholder'=>"Insérez le nombre d'unités du bien"]])
            ->add('valeurAcquisition',IntegerType::class, [
                'label'=>'Valeur d acquisition',
                'constraints' => new Length(['min' => 1,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez la valeur d'acquisition du bien"]])
            ->add('dureeAmortissement',IntegerType::class, [
                'label'=>'durée d amortissement',
                'constraints' => new Length(['min' => 1,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez la durée d'amortissement du bien en nombre d'années"]])  
            
            ->add('image', FileType::class, [
                'mapped' => false,
                'attr'=>['placeholder'=>"Insérez une image du bien"]

            ])

            //__________________________________________________________________________________________________
            ->add('compteActif', ChoiceType::class, [
                'choices'  => [
                    'Sans'=>null,
                    '204000'=>204000,
                    '213000'=>213000,
                    '213001'=>213001,
                    '213002'=>213002,
                    '218200'=>218200,
                    '2130020'=>2130020,
                ],
            ])
            ->add('compteAmortissement', ChoiceType::class, [
                'choices'  => [
                    'Sans'=>null,
                    '280400'=>280400,
                    '2813000'=>2813000,
                    '2813001'=> 2813001,
                    '28130020'=> 28130020,
                    '28182002'=> 28182002,    
                ],
            ])
            ->add('compteAmortissement', ChoiceType::class, [
                'choices'  => [
                    'Sans'=>null,
                    '280400'=>280400,
                    '2813000'=>2813000,
                    '2813001'=> 2813001,
                    '28130020'=> 28130020,
                    '28182002'=> 28182002,    
                ],
            ])
            ->add('compteDotation', ChoiceType::class, [
                'choices'  => [
                    'Sans'=>null,
                    '681100'=>681100,
                    '681200'=>681200,
                    '68120020'=> 68120020,
   
                ],
            ])
            ->add('codeInvNat',TextType::class, [
                'label'=>'Code inventaire-nature',
                'constraints' => new Length(['min' => 3,'max' => 12]),
                'attr'=>['placeholder'=>"Insérez le code nature inventaire"]])
            
            ->add('libelleInvNat',TextType::class, [
                'label'=>'Libellé nature inventaire',
                'constraints' => new Length(['min' => 3,'max' => 12]),
                'attr'=>['placeholder'=>"Insérez le libellé inventaire-nature"]])
            //__________________________________________________________________________________________________

            ->add('Structure', EntityType::class, [
                // looks for choices from this entity
                'class' => Structure::class,
                'attr'=>['placeholder'=>"Insérez structure de rattachement"],
            
                // uses the User.username property as the visible option string
                'choice_label' => 'nomStructure',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
                'attr'=>['placeholder'=>"Insérez la structure de rattachement"]
            ])


            ->add('Service', EntityType::class, [
                // looks for choices from this entity
                'class' => Service::class,
                'attr'=>['placeholder'=>"Insérez service de rattachement"],
            
                // uses the User.username property as the visible option string
                'choice_label' => 'nomService',
                //'disabled' => true,
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
                'attr'=>['placeholder'=>"Insérez le service de rattachement"]
            ])
            ->add('submit', SubmitType::class, [
                'label'=>"Créer un bien"
            ])
            ->add('reset', ResetType::class, [
                'label'=>"Annuler"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
