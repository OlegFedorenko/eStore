<?php

namespace App\Form;

use FOS\UserBundle\Form\Type\ProfileFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    public function getParent()
    {
        return ProfileFormType::class;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('username')
            ->add('firstName', null, ['label' => 'label.firstName'])
            ->add('lastName', null, ['label' => 'label.lastName'])
            ->add('address', null, ['label' => 'label.address']);
    }
}