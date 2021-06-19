<?php

namespace App\Form;

use App\Entity\Ordinateurs;
use App\Entity\TypeOrdinateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OrdinateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modele', TextType::class, [
                'label' => "Model de l'ordinateur",
            ])
            ->add('processeur', TextType::class, [
                'label' => "Type processeur de l'ordinateur",
            ])
            ->add('frequence', NumberType::class, [
                'label' => "Frequence de l'ordinateur",
            ])
            ->add('ram', NumberType::class, [
                'label' => "Taille de la RAM de l'ordinateur",
            ])
            // ->add('typeRam')
            ->add('disque', IntegerType::class, [
                'label' => "Taille du disque dur de l'ordinateur",
            ])
            ->add('type', EntityType::class, [
                'class' => TypeOrdinateur::class,
                'label' => "Type d'ordinateur",
                'choice_label' => "libelle",
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ordinateurs::class,
        ]);
    }
}
