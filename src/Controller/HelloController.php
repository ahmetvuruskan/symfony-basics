<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{

    private array $messages = [
        ['message' => 'Hello', 'created' => '2023/12/30'],
        ['message' => 'Hi', 'created' => '2023/11/30'],
        ['message' => 'Bye', 'created' => '2022/10/30'],
    ];

    #[Route('/{limit<\d+>?3}', name: 'app_index', methods: ['GET'])]
    public function index($limit): Response
    {

        $data = [
            'messages' => $this->messages,
            'limit' => $limit
        ];
        return $this->render('Hello/index.html.twig', $data);
    }

    #[Route('/one/{id<\d+>?0}', name: 'app_show_one')]
    public function showOne(int $id): Response
    {
        $data = [
            'message' => $this->messages[$id],
        ];
        return $this->render('Hello/show_one.html.twig', $data);

    }
}