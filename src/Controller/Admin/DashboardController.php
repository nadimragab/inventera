<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use App\Entity\User;
use App\Entity\Service;
use App\Entity\Structure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Inventera');
    }


    public function configureMenuItems(): iterable
    {
        #yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Les utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Les structures', 'fas fa-hotel', Structure::class);
        yield MenuItem::linkToCrud('Les services', 'fas fa-bell', Service::class);
        yield MenuItem::linkToCrud('Les biens', 'fas fa-store', Bien::class);
    }
}
