<?php

namespace App\Controller;

use App\Form\BookingTicketsType;
use App\Services\PriceCalculator;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="ticket")
     * @param Request $request
     * @param SessionInterface $session
     * @param PriceCalculator $calculator
     * @return Response
     * @throws Exception
     */
    public function index(Request $request,SessionInterface $session, PriceCalculator $calculator):Response
    {

        $booking = $session->get('booking');

        $form = $this->createForm(BookingTicketsType::class, $booking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $calculator->computeBookingPrice($booking);
            $session->set('booking', $booking);
            return $this->redirectToRoute('order');

        }
        return $this->render("ticket/index.html.twig", [
            'current_menu'=>'ticket',
            'form'=> $form->createView()
        ]);
    }
}