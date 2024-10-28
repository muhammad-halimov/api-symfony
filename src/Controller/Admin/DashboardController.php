<?php
namespace App\Controller\Admin;

use App\Entity\History;
use App\Entity\MainScreen;
use App\Entity\Participants;
use App\Repository\MainScreenRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    private readonly MainScreenRepository $mainScreenRepository;

    #[Route(path: '/', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Админ-панель')
            ->setFaviconPath('favicon.ico')
            ->renderContentMaximized()
            ->setLocales(['en', 'ru']);
    }

    public function __construct(
        MainScreenRepository $mainScreenRepository,
    )
    {
        $this->mainScreenRepository = $mainScreenRepository;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Основные');
        yield MenuItem::linkToCrud('Участники', 'fa fa-list', Participants::class);
        yield MenuItem::linkToCrud('История', 'fa fa-list', History::class);

        if ($this->mainScreenRepository->count() === 0) {
            yield MenuItem::linkToCrud('Экраны', 'fa fa-image', MainScreen::class)
                ->setAction(Action::NEW);
        } else {
            yield MenuItem::linkToCrud('Экраны', 'fa fa-image', MainScreen::class)
                ->setAction(Action::EDIT)->setEntityId($this->mainScreenRepository->findAll()[0]->getId());

        yield MenuItem::section('Настройки');
        yield MenuItem::linkToUrl('API', 'fa fa-link', '/api')->setLinkTarget('_blank');
        //yield MenuItem::linkToUrl('API', 'fa fa-link', '/api')->setLinkTarget('_blank')
        //->setPermission('ROLE_ADMIN');
        }
    }
}
