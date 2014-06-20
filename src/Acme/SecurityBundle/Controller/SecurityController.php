<?php

namespace Acme\SecurityBundle\Controller;

use Acme\SecurityBundle\Entity\User;
use Acme\SecurityBundle\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session &&
            $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' :
            $session->get(SecurityContextInterface::LAST_USERNAME);
        return $this->render(
            'AcmeSecurityBundle:Security:login.html.twig',
            array(
            // last username entered by the user
                'last_username' => $lastUsername,
                'error' => $error,
            )
        );
    }

    public function queryAction(Request $request){
        $repository = $this->getDoctrine()
            ->getRepository('AcmeSecurityBundle:User');

        $users = $repository->findAll();

        return $this->render('AcmeSecurityBundle:Security:query.html.twig',array('users'=>$users));
    }

    private function getRolesByIds($ids) {
        $roles = array();
        $em = $this->getDoctrine()
            ->getRepository('AcmeSecurityBundle:Role');
        foreach($ids as $id) {
            $roles[] = $em->find($id);
        }
        return $roles;
    }

    public function createAction(Request $request){
        $username = $request->request->get('_username');
        $password = $request->request->get('_password');

        $items = $request->request->get('roles');

        $role = $this->getRolesByIds($items);


        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->addRoles($role);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $repository = $this->getDoctrine()
            ->getRepository('AcmeSecurityBundle:User');

        $users = $repository->findAll();

        return $this->render('AcmeSecurityBundle:Security:query.html.twig',array('users'=>$users));
    }

    public function editAction($id){

        $user = $this->getDoctrine()
            ->getRepository('AcmeSecurityBundle:User')
            ->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        $repository = $this->getDoctrine()
            ->getRepository('AcmeSecurityBundle:User');

        $user = $repository->find($id);

        return $this->render('AcmeSecurityBundle:Security:update.html.twig',array('user'=>$user));
    }

    public function deleteAction($id){

        $user = $this->getDoctrine()
            ->getRepository('AcmeSecurityBundle:User')
            ->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $repository = $this->getDoctrine()
            ->getRepository('AcmeSecurityBundle:User');

        $users = $repository->findAll();

        return $this->render('AcmeSecurityBundle:Security:query.html.twig',array('users'=>$users));
    }

    public function updateAction(Request $request){
        $id = $request->request->get('_id');
        $username = $request->request->get('_username');
        $password = $request->request->get('_password');

        $user = $this->getDoctrine()
            ->getRepository('AcmeSecurityBundle:User')
            ->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        $em = $this->getDoctrine()->getManager();
        $user->setUsername($username);
        $user->setPassword($password);
        $em->flush();

        $repository = $this->getDoctrine()
            ->getRepository('AcmeSecurityBundle:User');

        $users = $repository->findAll();

        return $this->render('AcmeSecurityBundle:Security:query.html.twig',array('users'=>$users));
    }
}
