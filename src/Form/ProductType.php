<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title'      , TextType::class       , [ 'attr' => ['class' => 'form-control'] ])
            ->add('description', TextareaType::class   , [ 'attr' => ['class' => 'form-control'], 'required' => false ])
            ->add('price'      , MoneyType::class      , [ 'attr' => ['class' => 'form-control'] ])
            ->add('stock'      , IntegerType::class    , [ 'attr' => ['class' => 'form-control'] ])
            ->add('brand'      , TextType::class       , [ 'attr' => ['class' => 'form-control'], 'required' => false ])
            ->add('images'     , CollectionType::class , [
                'entry_type' => TextType::class,
                'required' => false,
                'allow_extra_fields' => true,
            ])

            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ])

            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
    }
}
