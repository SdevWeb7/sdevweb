<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordFormType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options): void
   {
      $builder
         ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'options' => [
               'attr' => [
                  'autocomplete' => 'new-password',
                  'class' => 'form-fields'
               ],
            ],
            'first_options' => [
               'constraints' => [
                  new NotBlank([
                     'message' => 'Entrez un mot de passe',
                  ]),
                  new Length([
                     'min' => 6,
                     'minMessage' => 'Le mot de passe ne doit pas excéder {{ limit }} caractères',
                     // max length allowed by Symfony for security reasons
                     'max' => 4096,
                  ]),
               ],
               'label' => 'Nouveau mot de passe',
               'label_attr' => [
                  'class' => 'form-labels'
               ]
            ],
            'second_options' => [
               'label' => 'Confirmation',
            ],
            'invalid_message' => 'Les 2 champs mot de passe doivent être identiques',
            // Instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
         ])
      ;
   }

   public function configureOptions(OptionsResolver $resolver): void
   {
      $resolver->setDefaults([]);
   }
}