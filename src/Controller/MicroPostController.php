<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\MicroPost;
use App\Form\CommentType;
use App\Form\MicroPostType;
use App\Repository\CommentsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MicroPostRepository;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'micro_post_index')]
    public function index(MicroPostRepository $entityManager): Response
    {
        $posts = $entityManager->findAll();
        $data = [
            'posts' => $posts
        ];
        return $this->render('micro_post/index.html.twig', $data);
    }

    #[Route('/micro-post/{id<\d+>?0}', name: 'micro_post_show_one')]
    public function showOne(#[MapEntity] MicroPost $microPost): Response
    {
        $data = [
            'post' => $microPost
        ];
        return $this->render('micro_post/show.html.twig', $data);
    }

    #[Route('/micro-post/add', name: 'micro_post_add', methods: ['GET', 'POST'])]
    public function add(Request $request, MicroPostRepository $posts): Response
    {

        $form = $this->createForm(MicroPostType::class, new MicroPost());
        $form->handleRequest($request);
        //$errors =$form->getErrors(true);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setCreated(new \DateTime());
            $posts->add($post, true);
            $this->addFlash("success", "The post has been added");
            return $this->redirectToRoute('micro_post_index');
        }
        return $this->render('micro_post/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/micro-post/{post}/edit', name: 'micro_post_edit', methods: ['GET', 'POST'])]
    public function edit(MicroPost $post, Request $request, MicroPostRepository $posts): Response
    {

        $form = $this->createForm(MicroPostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $posts->add($post, true);
            $this->addFlash("success", "The post has been updated");
            return $this->redirectToRoute('micro_post_index');
        }
        return $this->render('micro_post/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/micro-post/{post}/comment', name: 'micro_post_comment', methods: ['GET', 'POST'])]
    public function addComment(MicroPost $post, Request $request, CommentsRepository $comments): Response
    {

        $form = $this->createForm(CommentType::class, new Comments());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comments->add($comment, true);
            $comment->setPost($post);
            $comments->add($comment, true);
            $this->addFlash("success", "The comment has been added");
            return $this->redirectToRoute('micro_post_show_one',
                [
                    'post' => $post->getId()
                ]
            );
        }
        return $this->render('micro_post/comment.html.twig', [
            'form' => $form
        ]);
    }


}
