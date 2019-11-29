<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entity_manager = $options['entity_manager'];

        $builder
            ->add('title'      , TextType::class)
            ->add('description', TextareaType::class)
            ->add('price'      , IntegerType::class)
            ->add('stock'      , IntegerType::class)
            ->add('brand'      , TextType::class, ['required' => false])
            ->add('images'     , FileType::class, ['required' => false])

            //Toute cette partie sert à ajouter au formulaire la possibilité de mettre plusieurs catégories
            ->add('categories', EntityType::class, [
                'class'        => Category::class,
                'em'           => $entity_manager,
                'choice_label' => 'name',
                'multiple'     => true
            ])

            ->add('save', SubmitType::class, [
                'attr'=> [
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('entity_manager');

        $resolver->setDefaults([
            'entityManager' => null,
            'data_class' => Product::class,
        ]);
    }
}
