<?php

namespace App\Controller\Admin;

use App\Entity\Poems;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PoemsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Poems::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInSingular('Поэма')
            ->setEntityLabelInPlural('Поэмы')
            ->setPageTitle(Crud::PAGE_NEW, 'Создать поэму')
            ->setPageTitle(Crud::PAGE_EDIT, 'Изменить поэму');
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Название')
            ->setColumns(8);

        yield TextField::new('description', 'Описание')
            ->setColumns(8);

        yield TextEditorField::new('text', 'Текст')
            ->setColumns(8);
    }
}
