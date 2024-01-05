<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\MicroPost;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\MicroPostRepository;
use App\Repository\UserProfileRepository;
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
    public function index(MicroPostRepository $posts): Response
    {

        $post = new MicroPost();
        $comment = new Comments();
        $post->setTitle("Hello");
        $post->setText("Hello");
        $post->setCreated(new \DateTime());
        $comment->setText("Demo Comment");
        $post->addComment($comment);
        $posts->add($post,true);
//        $user = new User();
//        $user->setEmail("ahmetfatih0702@gmail.com");
//        $user->setPassword("12345678");
//
//        $profile = new UserProfile();
//        $profile->setUserId($user);
//        $profiles->add($profile,true);
//        $profile = $profiles->find(4);
//        $profiles->remove($profile,true);
        $data = [
            'messages' => $this->messages,
            'limit' => 10
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