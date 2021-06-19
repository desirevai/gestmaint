<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Services;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\OrdinateursType;
use App\Form\PeripheriquesType;

class AgentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenoms', TextType::class)
            ->add('contacts', TelType::class)
            ->add('emailPerso', EmailType::class, [
                'label' => "Email Personnelle"
            ])
            ->add('emailPro', EmailType::class, [
                'label' => "Email Professionelle"
            ])
            ->add('service', EntityType::class, [
                'class' => Services::class,
                'label' => "Service de l'agent",
                'attr' => [
                    'class' => 'js-example-basic-single select2-hidden-accessible',
                    'style' => "width:100%"
                ],
            ])
            ->add('ordinateurs', CollectionType::class, [
                'entry_type' => OrdinateursType::class,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('peripheriques', CollectionType::class, [
                'entry_type' => PeripheriquesType::class,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Agents::class,
        ]);
    }
}
