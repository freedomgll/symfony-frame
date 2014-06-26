<?php

namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginRegisterAction(){
        return $this->render('AcmeBlogBundle:Admin:register.html.twig');
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

        if(isset($error)){

        }

        return $this->render('AcmeBlogBundle:Admin:register.html.twig',array('errors'=>$error));
    }

}
