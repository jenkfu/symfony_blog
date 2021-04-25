<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index(): Response
    {

        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findAll(); // ou $posts = $em->getRepository(App\Entity\Post)->findAll(); 

        return $this->render('post/index.html.twig', [
            'posts' => $posts, 
        ]); // ou compact('posts);
    }

    /**
     * @Route("/post/create", methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {
      $form =  $this->createFormBuilder()
        ->add('title')
        ->add('content')
        ->add('date')
        ->getForm()
        ;

        // if($request->isMethod('POST')) {
        //    $data = $request->request->all();
        //  $post = new Post();
        //  $post->setTitle($data['title']);
        //  $post->setContent($data['content']);
        //  $post->setCreatedAt(\DateTime::createFromFormat('d-m-Y',$data['date']));
        //  $entityManager = $this->getDoctrine()->getManager();
        //  $entityManager->persist($post);
        // $entityManager->flush();

        // return $this->redirectToRoute('post');

        // }  
        return $this->render('post/create.html.twig', [
            'new' => 'Nouvel album', 
            'albumForm' => $form->createView(),
        ]);
    }
}
