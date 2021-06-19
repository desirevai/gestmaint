<?php

namespace App\Form;

use App\Entity\Techniciens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TechnicienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            // ->add('prenoms')
            // ->add('contact')
            // ->add('email')
            // ->add('interventions')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Techniciens::class,
        ]);
    }
}
