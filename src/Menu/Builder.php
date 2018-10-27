<?php

namespace App\Menu;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Knp\Menu\FactoryInterface;

class Builder
{
    /**
     * @param FactoryInterface $factory
     */
    private $factory;

    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    public function __construct(FactoryInterface $factory, EntityManagerInterface $entityManager)
    {
        $this->factory = $factory;
        $this->entityManager = $entityManager;
    }


    public function mainMenu(array $options)
    {
        $menu = $this->factory->createItem('root', [
            'childrenAttributes' => ['class'=>'navbar-nav mr-auto'] ]);

        $menu->addChild('Home', ['route' => 'homepage']);

        $catalogue = $menu->addChild('Catalogue',[
            'attributes' => [
                'dropdown' => true,
            ],
        ]);

        /**
         * @var EntityRepository $categoryRepo
         */
        $categoryRepo = $this->entityManager->getRepository(Category::class);

        /**
         * @var Category[] $categories
         */
        $categories = $categoryRepo->findBy([],['name' => 'ASC']);

        foreach ($categories as $category)
        {
            $catalogue->addChild($category->getName(), [
               'route' => 'category_show',
               'routeParameters' => [
                   'id' => $category->getId(),
               ]
            ]);
        }

        $catalogue ->addChild('All', [
            'route' => 'categories',
            'attributes' => [
                'divider_prepend' => true,
            ]
        ]);

        $menu->addChild('Feedback', ['route' => 'feedback']);

        return $menu;
    }
}