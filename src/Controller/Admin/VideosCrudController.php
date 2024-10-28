<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Field\VichFileField;
use App\Entity\Videos;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VideosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Videos::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInSingular('Видео')
            ->setEntityLabelInPlural('Видео')
            ->setPageTitle(Crud::PAGE_NEW, 'Создать видео')
            ->setPageTitle(Crud::PAGE_EDIT, 'Изменить видео');
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Название')
            ->setColumns(8);

        yield VichFileField::new('videoFile', 'Видео')
            ->setHelp('
                <div class="mt-3">
                    <span class="badge badge-info">*.mp4</span>
                    <span class="badge badge-info">*.avi</span>
                    <span class="badge badge-info">*.mkv</span>
                </div>
            ')
            ->onlyOnForms()
            ->setFormTypeOption('allow_delete', false)
            ->setRequired(false)
            ->setColumns(8);

        yield VichFileField::new('video', 'Видео')
            ->hideOnForm()
            ->setColumns(8);
    }
}
