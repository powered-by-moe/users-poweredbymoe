<?php

namespace PoweredByMoe\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\User;

class DefaultController extends FOSRestController
{
    public function indexAction()
    {
        $data = ['hello' => 'world'];
        $view = $this->view($data);
        return $this->handleView($view);
    }

    public function userAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $view = $this->view($user);
        return $this->handleView($view);
    }
}
