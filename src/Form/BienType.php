<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class, [
                'label'=>'Nom du bien',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez le nom de votre nouveau bien"]])
            ->add('description',TextType::class, [
                'label'=>'Description',
                'constraints' => new Length(['min' => 2,'max' => 256]),
                'attr'=>['placeholder'=>"Insérez la description de votre bien"]])
            ->add('referenceBien',TextType::class, [
                'label'=>'Référence du bien',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez la référence pour le code QR"]])
            ->add('dateAcquisition',DateType::class, [
                'label'=>'Date acquisition',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez la date d'acquisition de votre bien"]])
            ->add('nombreUniteLot',IntegerType::class, [
                'label'=>'Nombre unités',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez le nombre d'unités du bien"]])
            ->add('attachment', FileType::class, [
                'label'=>'Image du bien',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez une image de votre bien"]])
            ->add('service',TextType::class, [
                'label'=>'Service de rattachement',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez le service de rattachement de votre bien"]])

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
