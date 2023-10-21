<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options): void
   {
      $builder
         ->add('username', TextType::class, [
            'label' => 'Nom d\'utilisateur'
         ])
         ->add('email', EmailType::class, [
            'label' => 'Adresse e-mail'
         ])
         ->add('agreeTerms', CheckboxType::class, [
            'label' =>'Conditions d\'utilisation',
            'attr' => [
               'class' => 'agreeTerms'
            ],
            'mapped' => false,
            'constraints' => [
               new IsTrue([
                  'message' => 'Vous devez accepter les conditions',
               ]),
            ],
         ])
         ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les 2 champs doivent correspondre.',
            'required' => true,
            'first_options'  => [
               'label' => 'Mot de passe'
            ],
            'second_options' => [
               'label' => 'Confirmer mot de passe'
            ],
            'mapped' => false,
            'constraints' => [
               new Length([
                  'min' => 6,
                  'minMessage' => 'Le mot de passe ne doit pas dépasser {{ limit }} caractères',
                  'max' => 40,
               ]),
            ],
         ]);
   }

   public function configureOptions(OptionsResolver $resolver): void
   {
      $resolver->setDefaults([
         'data_class' => User::class,
         'constraints' => [
            new UniqueEntity(['fields' => 'email']),
            new UniqueEntity(['fields' => 'username'])
         ],
      ]);
   }
}