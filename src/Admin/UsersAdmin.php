<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UsersAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('firstName')
            ->addIdentifier('lastName')
            ->addIdentifier('email')
            ->addIdentifier('address');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('address');
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form
        ->add('firstName')
        ->add('lastName')
        ->add('email')
        ->add('address');
    }
}