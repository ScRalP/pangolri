<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username'  , TextType::class    , [ 'attr' => ['placeholder' => 'xX-DarkSasuke-Xx'] ])
            ->add('password'  , RepeatedType::class, [
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
                'required' => true,
                'invalid_message' => 'The password fields must match.',
                'type' => PasswordType::class,
            ])
            ->add('email'     , EmailType::class   , [ 'attr' => ['placeholder' => 'example@gmail.com' ] ])
            ->add('cellphone' , TextType::class    , [ 'attr' => ['placeholder' => '06 12 45 95 87'    ] ])
            ->add('first_name', TextType::class    , [ 'attr' => ['placeholder' => 'Jhon'              ] ])
            ->add('last_name' , TextType::class    , [ 'attr' => ['placeholder' => 'Ravolti'           ] ])
            ->add('age'       , NumberType::class  , [ 'attr' => ['placeholder' => '56'                ] ])
            ->add('address'   , TextType::class    , [ 'attr' => ['placeholder' => '5 pennywise street'] ])
            ->add('save'      , SubmitType::class  , [
                'label' => 'Register'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
    }
}
