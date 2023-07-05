<?php

namespace App\Form;

use App\Entity\BlogItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr'=> [
                    'placeholder'=>'Entrez le titre du sujet',
                    'class'=>'form-name',
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'attr'=>[
                    'placeholder' => 'Bloguez...',
                    'class'=>'form-description',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
                'attr'=> [
                    'class'=>'form-submit',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlogItem::class,
        ]);
    }
}
