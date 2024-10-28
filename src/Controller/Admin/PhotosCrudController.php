<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Field\VichImageField;
use App\Entity\Photos;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PhotosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photos::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInSingular('Фото')
            ->setEntityLabelInPlural('Фото')
            ->setPageTitle(Crud::PAGE_NEW, 'Создать фото')
            ->setPageTitle(Crud::PAGE_EDIT, 'Изменить фото');
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title')
            ->setColumns(8);

        yield VichImageField::new('imageFile', 'Картинка')
            ->setHelp('
                <div class="mt-3">
                    <span class="badge badge-info">*.jpg</span>
                    <span class="badge badge-info">*.jpeg</span>
                    <span class="badge badge-info">*.png</span>
                    <span class="badge badge-info">*.webp</span>
                </div>
            ')
            ->onlyOnForms()
            ->setFormTypeOption('allow_delete', false)
            ->setRequired(false)
            ->setColumns(8);

        yield VichImageField::new('image', 'Картинка')
            ->hideOnForm()
            ->setColumns(8);
    }
}
