<?php

namespace App\Form;

use App\Entity\Structure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomStructure',TextType::class, [
                'label'=>'Nom de la structure',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez le nom de votre nouvelle structure"]])
            ->add('adresse',TextType::class, [
                'label'=>'Adresse',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Insérez l'adresse de votre nouvelle structure"]])
            ->add('description',TextType::class, [
                'label'=>'Description',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Proposez une description de votre nouvelle structure"]])
            ->add('referenceStructure',TextType::class, [
                'label'=>'Référence',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Introduisez la référence permettant d'indexer la structure"]])
            ->add('submit', SubmitType::class, [
                'label'=>"Créer une structure"
            ])
            ->add('reset', ResetType::class, [
                'label'=>"Annuler"
            ])
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}
