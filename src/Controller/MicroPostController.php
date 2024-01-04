<?php

namespace App\Controller;

use App\Entity\MicroPost;
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

    #[Route('/micro-post/add', name: 'micro_post_add',methods: ['GET','POST'])]
    public function add(Request $request,MicroPostRepository $posts) : Response
    {
        $microPost = new MicroPost();
        $form = $this->createFormBuilder($microPost)
            ->add("title")
            ->add("text")
            ->add('submit',SubmitType::class,['label' => 'Add'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            $post->setCreated(new \DateTime());
            $posts->add($post,true);
            $this->addFlash("success","The post has been added");
            return $this->redirectToRoute('micro_post_index');
        }
        return $this->render('micro_post/add.html.twig', [
            'form' => $form
        ]);
    }



}
