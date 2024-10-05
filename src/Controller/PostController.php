<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use App\Service\PostGeneratorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    private const MAX_POSTS = 5;

    private PostGeneratorInterface $postGenerator;

    public function __construct(PostGeneratorInterface $postGenerator)
    {
        $this->postGenerator = $postGenerator;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    #[Route('/posts', name: 'post_list')]
    public function list(
        BlogPostRepository $blogPostRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $queryBuilder = $blogPostRepository->createQueryBuilder('bp')
            ->orderBy('bp.createdAt', 'DESC');

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            self::MAX_POSTS
        );

        return $this->render('post/list.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/post/new', name: 'create_post')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
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

        return $this->render('post/create.html.twig');
    }

    #[Route('/post/show/{id}', name: 'post_show')]
    public function show(BlogPost $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
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

    #[Route('/api/random-post', name: 'get_random_post')]
    public function getRandomPost(): JsonResponse
    {
        $post = $this->postGenerator->generatePost();

        return new JsonResponse($post);
    }
}