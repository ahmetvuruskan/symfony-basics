<?php

namespace App\Controller;

use App\Entity\MicroPost;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        return $this->render('micro_post/index.html.twig',$data);
    }

    #[Route('/micro-post/{id<\d+>?0}', name: 'micro_post_show_one')]
    public function showOne(#[MapEntity] MicroPost $microPost)
    {
        $data = [
            'post' => $microPost
        ];
        return $this->render('micro_post/show.html.twig', $data);
    }


}
