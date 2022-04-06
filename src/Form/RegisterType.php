<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                'label'=>'Prénom',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Prénom du nouvel utilisateur"]
        ])
            ->add('nom',TextType::class, [
                'label'=>'Nom',
                'constraints' => new Length(['min' => 2,'max' => 30]),
                'attr'=>['placeholder'=>"Nom du nouvel utilisateur"]
        ])
            ->add('email', EmailType::class, [
                'label'=>'Courrier éléctronique',
                'constraints' => new Length(['min' => 5,'max' => 60]),
                'attr'=>['placeholder'=>"Adresse e-mail du nouvel utilisateur"]
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'les mots de passe sont différents',
            'required' => true,
            'first_options' => [
                'label' => 'Mot de passe', 'attr' => [
                    'placeholder' => 'Mot de passe du nouvel utilisateur'
                ]
            ],
            'second_options' => [
                'label' => 'Confirmation', 'attr' => [
                    'placeholder' => 'Confirmez le mot de passe'
                ]
            ],


        ])
        ->add('submit', SubmitType::class, [
            'label'=>"Créer un compte"
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
