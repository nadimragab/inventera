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

            ->add('referenceBien', TextType::class, [
                'disabled' => true,
                'label' => 'Référence du bien',
                'constraints' => new Length(['min' => 3, 'max' => 12]),
                'attr' => ['placeholder' => "Généré automatiquement par ELSEngine 0.1"]
            ])

            ->add('nom', TextType::class, [
                'label' => 'Nom du bien',
                'constraints' => new Length(['min' => 3, 'max' => 30]),
                'attr' => ['placeholder' => "Insérez le nom de votre nouveau bien"]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'constraints' => new Length(['min' => 8, 'max' => 1024]),
                'attr' => ['placeholder' => "Insérez la description de votre bien"]
            ])

            ->add('dateAcquisition', DateType::class, [
                'label' => 'Date acquisition',
                'data' => new \DateTime(),
                'widget' => 'choice',
                'input'  => 'datetime',
                'attr' => ['placeholder' => "Insérez la date d'acquisition de votre bien"]
            ])

            ->add('nombreUniteLot', IntegerType::class, [
                'required' => false,
                'label' => 'Nombre unités',
                'attr' => ['placeholder' => "Insérez le nombre d'unités du bien 'laissez par défault pour 1'"]
            ])

            ->add('valeurAcquisition', IntegerType::class, [
                'label' => 'Valeur d acquisition',
                'constraints' => new Length(['min' => 1, 'max' => 30]),
                'attr' => ['placeholder' => "Insérez la valeur d'acquisition du bien"]
            ])

            ->add('dureeAmortissement', IntegerType::class, [
                'required' => false,
                'label' => 'durée d amortissement',
                'attr' => ['placeholder' => "Insérez la durée d'amortissement du bien en nombre d'années 'laissez par défault pour 5'"]
            ])

            ->add('image', FileType::class, [
                'mapped' => false,
                'attr' => ['placeholder' => "Insérez une image du bien"]

            ])

            ->add('Structure', EntityType::class, [
                // looks for choices from this entity
                'class' => Structure::class,
                'attr' => ['placeholder' => "Insérez structure de rattachement"],

                // uses the User.username property as the visible option string
                'choice_label' => 'nomStructure',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
                'attr' => ['placeholder' => "Insérez la structure de rattachement"]
            ])


            ->add('Service', EntityType::class, [
                // looks for choices from this entity
                'class' => Service::class,
                'attr' => ['placeholder' => "Insérez service de rattachement"],

                // uses the User.username property as the visible option string
                'choice_label' => 'nomService',
                //'disabled' => true,
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
                'attr' => ['placeholder' => "Insérez le service de rattachement"]
            ])

            //__________________________________________________________________________________________________
            ->add('compteActif', ChoiceType::class, [
                'choices'  => [
                    'Sans' => null,
                    'Meuble restauration' => 21810,
                    'Equipement informatique' => 218200,
                    'Chambre froide' => 218300,
                    'Groupe éléctrogène' => 218304,
                    'Equipement de bureau' => 218307,
                    'Ustensile et équipement de cuisine' => 218311,
                    'Station climatisation' => 218314,
                    'Rayonnage et stockage équipement' => 218315,
                    'Meuble de chambre' => 218317,
                    'Rideau de chambre' => 218318,
                    'Matelas' => 218319,
                    'Equipement buanderie' => 218320,
                    'Extincteur et équipement de sécurité' => 218538,
                    'Equipement télévision' => 218539,
                    'Sonorisation' => 218540,
                    'Machine à café' => 218541,
                    'Meuble de loisir' => 218542,
                    'Camera de surveillance' => 218543,
                    'Equipement salle de sport' => 218544,
                ],
            ])
            ->add('compteAmortissement', ChoiceType::class, [
                'choices'  => [
                    'Commun' => 281000,
                ],
            ])
            /*->add('compteAmortissement', ChoiceType::class, [
                'choices'  => [
                    'Sans' => null,
                    '280400' => 280400,
                    '2813000' => 2813000,
                    '2813001' => 2813001,
                    '28130020' => 28130020,
                    '28182002' => 28182002,
                ],
            ])*/
            ->add('compteDotation', ChoiceType::class, [
                'choices'  => [
                    'Commun' => 628000,

                ],
            ])
            /*->add('codeInvNat', TextType::class, [
                'label' => 'Code inventaire-nature',
                'constraints' => new Length(['min' => 3, 'max' => 12]),
                'attr' => ['placeholder' => "Insérez le code nature inventaire"]
            ])

            ->add('libelleInvNat', TextType::class, [
                'label' => 'Libellé nature inventaire',
                'constraints' => new Length(['min' => 3, 'max' => 12]),
                'attr' => ['placeholder' => "Insérez le libellé inventaire-nature"]
            ])*/
            //__________________________________________________________________________________________________


            ->add('submit', SubmitType::class, [
                'label' => "Créer un bien"
            ])
            ->add('reset', ResetType::class, [
                'label' => "Annuler"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
