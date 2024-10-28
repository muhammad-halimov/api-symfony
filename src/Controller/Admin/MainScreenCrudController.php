<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\MainScreen;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Doctrine\ORM\EntityManagerInterface;

class MainScreenCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    public function setEntityManager(EntityManagerInterface $entityManager): void
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return MainScreen::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInSingular('Экран')
            ->setEntityLabelInPlural('Экраны')
            ->setPageTitle(Crud::PAGE_NEW, 'Создать экран')
            ->setPageTitle(Crud::PAGE_EDIT, 'Изменить экран');
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('titleSvo', 'Поле1')
            ->setColumns(8);

        yield TextField::new('titleHeroes', 'Поле2')
            ->setColumns(8);

        yield TextField::new('titleMembers', 'Поле3')
            ->setColumns(8);
    }
}
