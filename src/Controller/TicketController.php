<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Ticket;
use App\Form\BookingTicketsType;
use App\Services\PriceCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="ticket")
     * @param SessionInterface $session
     * @return Response
     */
    public function index(SessionInterface $session, PriceCalculator $calculator):Response
    {

        $booking = $session->get('booking');


        $form = $this->createForm(BookingTicketsType::class, $booking);
        if ($form->isSubmitted() && $form->isValid()) {
            // TODO 2 calculer le prix des billets
            $calculator->computeBookingPrice($booking);

            // TODO 3 rediriger vers la page de recap
            return $this->redirectToRoute('ticket');
        }
        return $this->render("ticket/index.html.twig", [
            'current_menu'=>'ticket',
            'form'=> $form->createView()
        ]);
    }
}