<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',  EmailType::class, ['disabled' => true,'label' => 'Adresse mail'])
            ->add('prenom', TextType::class ,['disabled' => true,'label'=> 'Prénom'])
            ->add('nom', TextType::class ,['disabled' => true,'label'=> 'Prénom'])
            ->add('old_password', PasswordType::class, [
                'label' => 'Mot de passe actuel',
                'mapped' => false,
                'invalid_message' => 'le mot de passe est incorrect',
                'attr' => [
                    'placeholder' => 'Mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'les mots de passe sont différents',
                'required' => true,
                'first_options' => [
                    'label' => 'Nouveau mot de passe', 'attr' => [
                        'placeholder' => 'Nouveau mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmer nouveau mot de passe', 'attr' => [
                        'placeholder' => 'Confirmer nouveau mot de passe'
                    ]
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Mettre à jour"
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
            'data_class' => User::class,
        ]);
    }
}
