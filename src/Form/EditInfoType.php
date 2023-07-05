<?php

namespace App\Form;

use App\Entity\UserInfo;
use Doctrine\DBAL\Types\DateImmutableType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class ,[
                'label' => false,
                'attr'=>[
                    'placeholder' => 'Entrez vos prénoms',
                    'class' => 'form-firstname',
                ]
            ])
            ->add('lastname', TextType::class ,[
                'label' => false,
                'attr'=>[
                    'placeholder' => 'Entrez votre nom',
                    'class' => 'form-lastname',
                ]
            ])
            ->add('birthday', DateType::class, [
                'label' => false,
                'attr'=>[
                    'class' => 'form-birthday',
                ]
            ])
            ->add('adresse', TextType::class ,[
                'label' => false,
                'attr'=>[
                    'placeholder' => 'Entrez votre adresse',
                    'class' => 'form-adresse',
                ]
            ])
            ->add('description', TextareaType::class ,[
                'label' => false,
                'attr'=>[
                    'placeholder' => 'Parlez de vous',
                    'class' => 'form-description2',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
                'attr' => [
                    'class' => 'form-submit2',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserInfo::class,
        ]);
    }
}
