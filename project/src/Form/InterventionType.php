<?php

namespace App\Form;

use App\Entity\Interventions;
use App\Entity\Ordinateurs;
use App\Entity\Pannes;
use App\Entity\Techniciens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('diagnostique', TextareaType::class, [
                'attr' => [
                    'rows' => 10
                ]
            ])
            ->add('Observation', TextareaType::class, [
                'attr' => [
                    'rows' => 10
                ]
            ])
            ->add('ordinateur', EntityType::class, [
                'class' => Ordinateurs::class,
                'attr' => [
                    'class' => 'js-example-basic-single select2-hidden-accessible',
                    'style' => "width:100%"
                ],
            ])
            ->add('pannes', EntityType::class, [
                'class' => Pannes::class,
                'multiple' => true,
                'label' => "Liste des pannes",
                'attr' => [
                    'class' => 'js-example-basic-multiple',
                    'style' => "width:100%"
                ],
            ])
            ->add('techniciens', EntityType::class, [
                'class' => Techniciens::class,
                'multiple' => true,
                'label' => "Techniciens ayant participé",
                'attr' => [
                    'class' => 'js-example-basic-multiple',
                    'style' => "width:100%"
                ],
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
                'label' => "Date de l'intervention",
                'attr' => [
                    'class' => 'form-control'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Interventions::class,
        ]);
    }
}
