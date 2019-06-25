<?php

namespace App\Controller;

use App\Form\BookingTicketsType;
use App\Manager\BookingManager;
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
     * @param BookingManager $bookingManager
     * @return Response
     */
    public function index(Request $request,BookingManager $bookingManager):Response
    {

        $booking = $bookingManager->getCurrentBooking();

        $form = $this->createForm(BookingTicketsType::class, $booking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bookingManager->computePrice($booking);
            return $this->redirectToRoute('order');

        }
        return $this->render("ticket/index.html.twig", [
            'current_menu'=>'ticket',
            'form'=> $form->createView()
        ]);
    }
}