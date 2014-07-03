<?php
/**
 * Created by PhpStorm.
 * User: lgu
 * Date: 14-7-3
 * Time: 下午2:48
 */

namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\Entity\RegisterUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * @Route("/blog/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/user",name="blog_user")
     * @Template()
     */
    public function userAction(Request $request){
        $repository = $this->getDoctrine()
            ->getRepository('AcmeSecurityBundle:User');

        $user = $repository->find($this->getUser()->getId());

        $ruser = new RegisterUser();
        $ruser->setId($user->getId());
        $ruser->setUsername($user->getUsername());
        $ruser->setPassword($user->getPassword());

        return $this->render('AcmeBlogBundle:Admin:user.html.twig',array('user'=>$ruser));
    }

    /**
     * @Route("/update",name="blog_update_user")
     * @Template()
     */
    public function updateAction(Request $request){
        $id = $request->request->get('_id');
        $username = $request->request->get('_username');
        $password = $request->request->get('_password');
        $passwordConfirm = $request->request->get('_passwordConfirm');

        $error = array();
        //very basic validation
        if($username ==''){
            $error[] = 'Please enter the username.';
        }

        if($password ==''){
            $error[] = 'Please enter the password.';
        }

        if($passwordConfirm ==''){
            $error[] = 'Please confirm the password.';
        }

        if($password != $passwordConfirm){
            $error[] = 'Passwords do not match.';
        }


        if(count($error) > 0){
            $user = new RegisterUser();
            $user->setId($id);
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setPasswordConfirm($passwordConfirm);

            return $this->render('AcmeBlogBundle:Admin:user.html.twig',array('errors'=>$error,'user'=>$user));
        }else{
            $user = $this->getDoctrine()
                ->getRepository('AcmeSecurityBundle:User')
                ->find($id);
            if (!$user) {
                throw $this->createNotFoundException(
                    'No user found for id '.$id
                );
            }

            $em = $this->getDoctrine()->getManager();
            $user->setPassword($password);
            $em->flush();

            return $this->redirect($this->generateUrl('blog_admin_index'));
        }
    }

} 