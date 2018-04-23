<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

       $qb= $this->getDoctrine()->getManager()->createQueryBuilder()->from('AppBundle:Blog','p')->select('p');
       $paginator  = $this->get('knp_paginator');
       $pagination=$paginator->paginate($qb, $request->query->get('page',1), 2);


        return $this->render('default/index.html.twig', array(
            'posts' => $pagination
        ));

    }


    /**
     * @Route("article/{id}", name="post_show")
     */
    public  function showAction(\AppBundle\Entity\Blog $post){

        return $this->render('default/show.html.twig',array('post'=>$post));

    }
}
