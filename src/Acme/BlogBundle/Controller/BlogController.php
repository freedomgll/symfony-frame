<?php
// src/Acme/BlogBundle/Controller/BlogController.php
namespace Acme\BlogBundle\Controller;
use Acme\BlogBundle\Entity\BUser;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use \DateTime;

use Acme\BlogBundle\Entity\Blog;

class BlogController extends Controller
{
    static $step = 2;

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

        #return $this->render('AcmeBlogBundle:Blog:index.html.twig',array('blogPosts'=>$blogPosts));
        return $this->render('AcmeBlogBundle:Blog:index.html.twig',array('blogPosts'=>$this->pagination(),'index'=>0));
    }

    public function pagination($beginIndex = 0) {
        $dql = "SELECT b FROM AcmeBlogBundle:Blog b";
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql)
            ->setFirstResult($beginIndex)
            ->setMaxResults(self::$step);

        $paginator = new Paginator($query, $fetchJoinCollection = true);

        $c = count($paginator);
        foreach ($paginator as $post) {
            $post->getPostTitle();
            #echo $post->getHeadline() . "\n";
        }
        return $paginator;
    }

    public function pageAction($index,$p)
    {
        if ($p == 'p') {
            if ($index - self::$step >= 0) {
                $index = $index - self::$step;
            }
            $blogPosts = $this->pagination($index);
        } elseif ($p == 'n') {
            $index = $index + self::$step;
            $blogPosts = $this->pagination($index);
        }

        return $this->render('AcmeBlogBundle:Blog:index.html.twig',array('blogPosts'=>$blogPosts,'index'=>$index));
    }

    public function viewpostAction($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AcmeBlogBundle:Blog');
        $blogPost = $repository->find($id);
        return $this->render('AcmeBlogBundle:Blog:viewpost.html.twig',array('blogPost'=>$blogPost));
    }

    public function addpostAction()
    {

        return $this->render('AcmeBlogBundle:Blog:add-post.html.twig');
    }

    public function editAction($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AcmeBlogBundle:Blog');
        $blog = $repository->find($id);

        return $this->render('AcmeBlogBundle:Blog:edit-post.html.twig',array('blog'=>$blog));
    }

    public function updateAction(Request $request)
    {
        $postId = $request->request->get('postId');
        $postTitle = $request->request->get('postTitle');
        $postDesc = $request->request->get('postDesc');
        $postCont = $request->request->get('postCont');

        $blog = new Blog();
        if(isset($postId)) {
            $repository = $this->getDoctrine()
                ->getRepository('AcmeBlogBundle:Blog');
            $blog = $repository->find($postId);
        }else{
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT b FROM AcmeBlogBundle:BUser b JOIN b.user u
                 WHERE u.id = :id')->setParameter('id',$this->getUser()->getId());

            try {
                $buser = $query->getSingleResult();
                $blog->setBuser($buser);
            } catch (\Doctrine\ORM\NoResultException $e) {
            }
        }

        $blog->setPostTitle($postTitle);
        $blog->setPostDesc($postDesc);
        $blog->setPostCont($postCont);
        $blog->setPostDate(new DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($blog);
        $em->flush();

        return $this->redirect($this->generateUrl('blog_admin_index'));
    }

    public function deleteAction($id)
    {
        $blog = $this->getDoctrine()
            ->getRepository('AcmeBlogBundle:Blog')
            ->find($id);
        if (!$blog) {
            throw $this->createNotFoundException(
                'No blog found for id '.$id
            );
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($blog);
        $em->flush();

        $repository = $this->getDoctrine()
            ->getRepository('AcmeBlogBundle:Blog');
        $blogPosts = $repository->findAll();

        return $this->render('AcmeBlogBundle:Admin:index.html.twig',array('blogPosts'=>$blogPosts));
    }

    public function indexAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $repository = $this->getDoctrine()
                ->getRepository('AcmeBlogBundle:Blog');
            $blogPosts = $repository->findAll();

        }elseif ($this->get('security.context')->isGranted('ROLE_USER')) {
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT b FROM AcmeBlogBundle:Blog b JOIN b.buser bu JOIN bu.user u
                 WHERE u.id = :id
                '
            )->setParameter('id',$this->getUser()->getId());

            $blogPosts = $query->getResult();
        }

        return $this->render('AcmeBlogBundle:Admin:index.html.twig',array('blogPosts'=>$blogPosts));
    }

    public function photoAction()
    {
        return new Response('<h1>Photos List</h1>');
    }
}