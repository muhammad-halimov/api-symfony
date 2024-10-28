<?php

namespace App\Controller\Admin;

use App\Entity\Participants;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;

class ParticipantsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Participants::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInSingular('Участник')
            ->setEntityLabelInPlural('Участники')
            ->setPageTitle(Crud::PAGE_NEW, 'Создать участника')
            ->setPageTitle(Crud::PAGE_EDIT, 'Изменить участника');
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('Главная');

        yield ChoiceField::new('type', 'Типы')
            ->setChoices([
                'СВО' => 'firstType',
                'Харьков' => 'secondType',
            ])
            ->setColumns(8)
            ->setRequired(true);

        yield TextField::new('name', 'Имя')
            ->setColumns(8)
            ->setRequired(true);

        yield TextField::new('surname', 'Фамилия')
            ->setColumns(8)
            ->setRequired(true);

        yield TextField::new('patronym', 'Отчество')
            ->setColumns(8)
            ->setRequired(true);

        yield TextEditorField::new('bio', 'Биография')
            ->setColumns(8)
            ->setRequired(true);

        yield DateField::new('birth', 'Дата рождения')
            ->setColumns(8);

        yield DateField::new('death', 'Дата смерти')
            ->setColumns(8);

        yield DateField::new('updated', 'Обновлено')
            ->setColumns(8)
            ->hideOnForm();

        yield CollectionField::new('photos', 'Фото')
            ->useEntryCrudForm(PhotosCrudController::class)
            ->hideOnIndex();


        yield FormField::addTab('Аудио');
            yield CollectionField::new('audios', 'Аудио')
                ->useEntryCrudForm(AudiosCrudController::class)
                ->hideOnIndex();


        yield FormField::addTab('Видео');
            yield CollectionField::new('videos', 'Видео')
                ->useEntryCrudForm(VideosCrudController::class)
                ->hideOnIndex();


        yield FormField::addTab('Поезия');
            yield CollectionField::new('poems', 'Поэзии')
                ->useEntryCrudForm(PoemsCrudController::class)
                ->hideOnIndex();
    }
}
