<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\History;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Doctrine\ORM\EntityManagerInterface;

class HistoryCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return History::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInSingular('История')
            ->setEntityLabelInPlural('Истории')
            ->setPageTitle(Crud::PAGE_NEW, 'Создать историю')
            ->setPageTitle(Crud::PAGE_EDIT, 'Изменить историю');
    }

    public function configureFields(string $pageName): iterable
    {
        yield ChoiceField::new('type', 'Типы')
            ->setChoices([
                'СВО' => 'firstType',
                'Харьков' => 'secondType',
            ])
            ->setColumns(8);

        yield CollectionField::new('images', 'Фото')
            ->useEntryCrudForm(PhotosCrudController::class);

        yield TextEditorField::new('bio', 'Описание')
            ->setColumns(8);
    }

    public function configureActions(Actions $actions): Actions
    {
        $currentCount = $this->entityManager->getRepository(History::class)->count();

        if ($currentCount >= 2) return $actions
            ->disable(Action::DELETE)
            ->disable(Action::NEW, Action::DELETE);
        else return $actions;
    }
}
