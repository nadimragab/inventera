<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\SlugType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomService',TextType::class, [
                'label'=>'Nom du service',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez le nom de votre nouveau service"]])
            ->add('description',TextType::class, [
                'label'=>'Description',
                'constraints' => new Length(['min' => 2,'max' => 256]),
                'attr'=>['placeholder'=>"Insérez la description de votre service"]])

            ->add('image',TextType::class, [
                'label'=>'Image',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez une photo du service"]])
            ->add('referenceService',TextType::class, [
                'label'=>'Référence du service',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez la référence pour le code QR"]])
            ->add('structure',TextType::class, [
                'label'=>'Structure de rattachement',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Sélectionnez la structure de rattachement"]])
            ->add('submit', SubmitType::class, [
                    'label'=>"Créer une structure"
                ])
            ->add('reset', ResetType::class, [
                    'label'=>"Annuler"
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
