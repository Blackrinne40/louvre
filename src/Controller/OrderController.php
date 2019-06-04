<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     * @param SessionInterface $session
     * @return Response
     */
    public function index(Request $request, SessionInterface $session):Response
    {

       $booking =  $session->get('booking');

        return $this->render("order/index.html.twig", [
            'current_menu'=>'order',
            'booking' => $booking
        ]);
    }
}