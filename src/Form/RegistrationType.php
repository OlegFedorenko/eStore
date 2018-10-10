<?php

namespace App\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function getParent()
    {
        return RegistrationFormType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('username')
            ->add('firstName', null, ['label' => 'label.firstName'])
            ->add('lastName', null, ['label' => 'label.lastName'])
            ->add('phone', null, ['label' => 'label.phone'])
            ->add('address', null, ['label' => 'label.address']);
//        ->add('firstName', null, ['label' => 'First Name'])
//        ->add('lastName', null, ['label' => 'Last Name'])
//        ->add('address', null, ['label' => 'Address']);
    }
}