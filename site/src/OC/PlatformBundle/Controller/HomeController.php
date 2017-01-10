<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function homeAction()
    {
        $user = $this->getUser();
        if($user!==null){
            return $this->render('OCPlatformBundle:HomeController:home.html.twig', array(
            // ...
        ));
        }else{
            $url = $this->generateUrl('fos_user_security_login');
            $response = new RedirectResponse($url);
            return $response;
        }
    }

}
