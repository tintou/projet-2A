<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    /**
     * @Route("/profile")
     */
    public function profileAction(Request $request)
    {
        $user = $this->getUser();
        
        $form = $this->createFormBuilder($user)
            ->add('username',TextType::class)
            ->add('email',EmailType::class)
            //->add('password',PasswordType::class, array('empty_data' => $user->getPassword()))
            ->add('dailymotion_id',TextType::class)
            ->add('dailymotion_password',PasswordType::class, array('always_empty'=>false))
            ->add('save',SubmitType::class, array('label'=>'Save'))
            ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        
        return $this->render('OCPlatformBundle:ProfileController:profile.html.twig', array('form'=>$form->createView(),'user'=>$user
        ));
    }

}
