<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '', name: 'page.')]
class PageController extends AbstractBaseController
{
    #[Route(path: '/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->redirectToRoute('forum.index');
    }

    #[Route(path: '/members', name: 'members', methods: ['GET'])]
    public function members(UserRepository $userRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $userRepository->findAllMembersQb(),
            $request->query->getInt('page', 1),
            25
        );

        return $this->render('pages/members.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route(path: '/team', name: 'team', methods: ['GET'])]
    public function team(UserRepository $userRepository): Response
    {
        return $this->render('pages/team.html.twig', [
            'administrators' => $userRepository->findByRole('ROLE_ADMIN'),
            'moderators' => $userRepository->findByRole('ROLE_MODERATOR'),
        ]);
    }
}
