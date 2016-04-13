<?php

namespace PbxG33k\MusicInfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PbxG33kMusicInfoBundle:Default:index.html.twig');
    }
}
