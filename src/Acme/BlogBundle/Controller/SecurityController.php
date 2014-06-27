<?php

namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\Entity\BUser;
use Acme\BlogBundle\Entity\RegisterUser;
use Acme\SecurityBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityController extends Controller
{
    public function loginRegisterAction(){
        return $this->render('AcmeBlogBundle:Admin:register.html.twig',array('user'=>new RegisterUser()));
    }

    public function registerAction(Request $request){
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
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setPasswordConfirm($passwordConfirm);

            return $this->render('AcmeBlogBundle:Admin:register.html.twig',array('errors'=>$error,'user'=>$user));
        }else{
            $user = new User();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->addRoles($this->getUserRole());

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $buser = new BUser();
            $buser->setUser($user);
            $em->persist($buser);
            $em->flush();

            $this->autoLogin($user);
        }

        return $this->redirect($this->generateUrl('blog'));
    }

    public function getUserRole() {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT r FROM AcmeSecurityBundle:Role r WHERE r.role = :role'
        )->setParameter('role','ROLE_USER');

        return $query->getResult();
    }

    public function autoLogin(User $user) {
        $token = new UsernamePasswordToken($user, null, 'secured_area', $user->getRoles());
        $this->get('security.context')->setToken($token);
        $this->get('session')->set('_security_main',serialize($token));
    }

}
