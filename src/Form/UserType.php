<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username'  , TextType::class    , [])
            ->add('email'     , EmailType::class   , [])
            ->add('cellphone' , TextType::class    , [])
            ->add('first_name', TextType::class    , [])
            ->add('last_name' , TextType::class    , [])
            ->add('age'       , NumberType::class  , [])
            ->add('address'   , TextType::class    , [])
            ->add('password'  , RepeatedType::class, [
                'first_name' => 'Password',
                'first_options' => [

                ],
                'second_name' => 'Repeate',

            ])
            ->add('save'      , SubmitType::class  , [
                'label' => 'Register'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
    }
}
