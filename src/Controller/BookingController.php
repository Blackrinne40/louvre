<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Ticket;
use App\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    /**
     * @Route("/booking", name="booking")
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function index(Request $request, SessionInterface $session): Response
    {
        $form = $this->createForm(BookingType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Booking $booking */
            $booking = $form->getData();

            $ticketsLimit= $booking->getNumberTickets();


            for ($i=1; $i<= $ticketsLimit ; $i++)
            {
                $booking->addTicket(new Ticket());
            }


            $session->set('booking', $booking);
            return $this->redirectToRoute('ticket');
        }


        return $this->render('booking/index.html.twig', [
            'current_menu' => 'booking',
            'form' => $form->createView()
        ]);
    }
}