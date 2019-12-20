<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextType::class, [
                'attr'=> ['class' => 'form-control', 'placeholder' => 'Tell us what you think about this product!'],
            ])
            ->add('save', SubmitType::class, [
                'attr'=> ['class' => 'btn btn-success'],
                'label' => 'Add comment'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
    }
}
