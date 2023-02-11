<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Entity\Comments;
use App\Entity\Users;
use App\Repository\NewsRepository;
use App\Repository\CommentsRepository;
use App\Repository\UsersRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{

    private NewsRepository $newsRepository;
    private CommentsRepository $commentsRepository;
    private UsersRepository $usersRepository;

    public function __construct(NewsRepository $newsRepository, CommentsRepository $commentsRepository, UsersRepository $usersRepository)
    {
        $this->newsRepository = $newsRepository;
        $this->commentsRepository = $commentsRepository;
        $this->usersRepository = $usersRepository;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $news = $this->newsRepository->count([]);
        $comments = $this->commentsRepository->count([]);
        $users = $this->usersRepository->count([]);
 
        return $this->render('admin/dashboard.html.twig', [
            'news' => $news,
            'comments' => $comments,
            'users' => $users
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Espace d\'administration')
            ->setFaviconPath('favicon.svg')
            ->setTranslationDomain('my-custom-domain')
            ->setTextDirection('ltr');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Navigation');
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-dashboard');
        yield MenuItem::linktoRoute('Acceuil', 'fas fa-home', 'main');
        yield MenuItem::LinkToLogout('Déconnexion', 'fas fa-sign-out');

        yield MenuItem::section('Gestion');
        yield MenuItem::linkToCrud('Actualités', 'fas fa-folder', News::class);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-folder', Comments::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-folder', Users::class);
    }
}
