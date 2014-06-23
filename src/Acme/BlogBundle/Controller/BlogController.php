<?php
// src/Acme/BlogBundle/Controller/BlogController.php
namespace Acme\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function listAction()
    {
        /*$posts = $this->get('doctrine')
            ->getManager()
            ->createQuery('SELECT p FROM AcmeBlogBundle:Post p')
            ->execute();
        return $this->render(
            'AcmeBlogBundle:Blog:list.html.php',
            array('posts' => $posts)
        );*/
        /*return new Response('<h1>List Action</h1>');*/
        return $this->render('AcmeBlogBundle:Blog:list.html.php');
    }

    public function showAction($id)
    {
        /*$post = $this->get('doctrine')
            ->getManager()
            ->getRepository('AcmeBlogBundle:Post')
            ->find($id);
        if (!$post) {
            // cause the 404 page not found to be displayed
            throw $this->createNotFoundException();
        }
        return $this->render(
            'AcmeBlogBundle:Blog:show.html.php',
            array('post' => $post)
        );*/
    }

    public function blogAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AcmeBlogBundle:Blog');
        $blogPosts = $repository->findAll();

        return $this->render('AcmeBlogBundle:Blog:index.html.twig',array('blogPosts'=>$blogPosts));
    }

    public function viewpostAction($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AcmeBlogBundle:Blog');
        $blogPost = $repository->find($id);
        $blogPost->setPostCont(htmlspecialchars_decode($blogPost->getPostCont()));
        return $this->render('AcmeBlogBundle:Blog:viewpost.html.php',array('blogPost'=>$blogPost));
    }

    public function photoAction()
    {
        return new Response('<h1>Photos List</h1>');
    }
}