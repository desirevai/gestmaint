<?php

namespace App\Form;

use App\Entity\Peripheriques;
use App\Entity\Agents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PeripheriquesSimpleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class, [
                'label' => "Nom du peripherique",
            ])
            ->add('agent', EntityType::class, [
                'class' => Agents::class,
                'label' => "Nom de l'agent",
                'attr' => [
                    'class' => 'js-example-basic-single select2-hidden-accessible',
                    'style' => "width:100%"
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Peripheriques::class,
        ]);
    }
}
