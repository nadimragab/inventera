<?php

namespace App\Form;

use App\Entity\Service;
use App\Entity\Structure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SelectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Structure', EntityType::class, [
            // looks for choices from this entity
            'class' => Structure::class,
            'attr'=>['placeholder'=>"Insérez structure de rattachement"],
        
            // uses the User.username property as the visible option string
            'choice_label' => 'nomStructure',
        
            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
            'attr'=>['placeholder'=>"Insérez la structure d'inventaire"]
        ])
        ->add('Service', EntityType::class, [
            // looks for choices from this entity
            'class' => Service::class,
            'attr'=>['placeholder'=>"Insérez service d'inventaire'"],
        
            // uses the User.username property as the visible option string
            'choice_label' => 'nomService',
            //'disabled' => true,
            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
            'attr'=>['placeholder'=>"Insérez le service de rattachement"]
        ])
        ->add('submit', SubmitType::class, [
            'label'=>"Choisir"
        ])

    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
