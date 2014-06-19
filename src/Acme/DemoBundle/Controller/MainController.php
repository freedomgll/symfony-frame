<?php
// src/Acme/DemoBundle/Controller/MainController.php
namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class MainController
{
    public function contactAction()
    {
        return new Response('<h1>Contact us!</h1>');
    }
}