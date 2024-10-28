<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Field\VichFileField;
use App\Controller\Admin\Field\VichImageField;
use App\Entity\Audios;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AudiosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Audios::class;
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
        yield TextField::new('title', 'Название')
            ->setColumns(8);

        yield VichFileField::new('audioFile', 'Аудио')
            ->setHelp('
                <div class="mt-3">
                    <span class="badge badge-info">*.mpeg</span>
                    <span class="badge badge-info">*.mp3</span>
                    <span class="badge badge-info">*.wav</span>
                </div>
            ')
            ->onlyOnForms()
            ->setFormTypeOption('allow_delete', false)
            ->setRequired(false)
            ->setColumns(8);

        yield VichFileField::new('audio', 'Аудио')
            ->hideOnForm()
            ->setColumns(8);
    }
}
