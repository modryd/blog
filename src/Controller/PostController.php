<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    private const MAX_POSTS = 50;

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    #[Route('/posts', name: 'post_list')]
    public function list(BlogPostRepository $blogPostRepository): Response
    {
        $blogPosts = $blogPostRepository->findBy(
            [],
            ['createdAt' => 'DESC'],
            self::MAX_POSTS
        );
        return $this->render('default/list.html.twig', [
            'blogPosts' => $blogPosts,
        ]);
    }

    #[Route('/post/{id}', name: 'post_show')]
    public function show(BlogPost $post): Response
    {
        return $this->render('default/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/post/new', name: 'create_post')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $content = $request->request->get('content');

            $blogPost = new BlogPost();
            $blogPost->setTitle($title);
            $blogPost->setContent($content);
            $blogPost->setCreatedAt(new \DateTime());

            $entityManager->persist($blogPost);
            $entityManager->flush();

            return $this->redirectToRoute('post_list');
        }

        return $this->render('default/create.html.twig');
    }

    #[Route('/post/delete/{id}', name: 'post_delete', methods: ['POST'])]
    public function delete(Request $request, BlogPost $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $post->getId(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();

            $this->addFlash('success', 'Post deleted successfully.');
        }

        return $this->redirectToRoute('post_list');
    }
}