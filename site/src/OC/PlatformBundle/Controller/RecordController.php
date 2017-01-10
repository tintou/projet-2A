<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Dailymotion;
use Curl;

class RecordController extends Controller
{
    /**
     * @Route("/record")
     */
    public function recordAction()
    {
    $api = new Dailymotion();
    
    $api->setGrantType(
        Dailymotion::GRANT_TYPE_PASSWORD,
        "fc97978e5589a52f86d8",
        "537033ac621be2a85d78caa35d273ac1897e8ca7",
        array(),
        array('username'=>'tintou_noel','password'=>'ferreira'));
        
    $result=$api->get('/me/videos',array('fields'=>array('id','title','owner')));
    
    return $result;
    }

}

