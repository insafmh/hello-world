<?php

namespace GestionComBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GestionComBundle:Default:indexC.html.twig');
    }
}
