<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Dailymotion;
use Curl;

class RecordController extends Controller
{
    /**
     * @Route("/record")
     */
    public function recordAction()
    {
        $user = $this->getUser();
        $api = new Dailymotion();
        
        $api->setGrantType(
            Dailymotion::GRANT_TYPE_PASSWORD,
            "fc97978e5589a52f86d8",
            "537033ac621be2a85d78caa35d273ac1897e8ca7",
            array(),
            array('username'=>$user->getDailymotionId(),'password'=>$user->getDailymotionPassword()));
            
        $result=$api->get('/me/videos',array('fields'=>array('id','title','owner')));
        $result = $result['list'];
        
        return $this->render('OCPlatformBundle:RecordController:record.html.twig', array('videos'=>$result,'user'=>$user));
        //*return new Response(json_encode($result));
    }

}

