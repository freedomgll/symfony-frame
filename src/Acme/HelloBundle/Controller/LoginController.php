<?php

namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeHelloBundle:Security:login.html.twig');
    }

    public function loginAction(Request $request)
    {
        $username = $request->request->get('_username');
        $password = $request->request->get('_password');

        return $this->render('AcmeHelloBundle:Login:loginSuccess.html.twig',array('username' => $username,'password' => $password));
    }
}
