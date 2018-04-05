<?php

namespace App\Form;

use App\Entity\Port;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PortType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('portName')
            ->add('photo')
            ->add('description')
            ->add('ingredients')
            ->add('priceRange')
            ->add('reviewedBy')
            ->add('date')
            ->add('isPublic')
            ->add('doesUserWantToMakePublic')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Port::class,
        ]);
    }
}
