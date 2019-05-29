<?php

namespace App\Controller;

use App\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="ticket")
     * @return Response
     */
    public function index():Response//SessionInterface $session):Response
    {

        //$booking = $session->get('booking');


        // $booking->addTicket(new Ticket());



        $form = $this->createForm(TicketType::class);//,$booking);
        return $this->render("ticket/index.html.twig", [
            'current_menu'=>'ticket',
            'form'=> $form->createView()
        ]);
    }
}