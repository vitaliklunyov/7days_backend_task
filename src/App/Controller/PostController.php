<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    private PostRepository $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/", name="app_post_index")
     */
    public function index(): Response
    {
        $posts = $this->repository->findBy([], ['id' => 'desc'], 100);

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/post/{id}", name="app_post_show")
     */
    public function show($id): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $this->repository->findOneById($id),
        ]);
    }
}
