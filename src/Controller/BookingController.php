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
     * @return Response
     * @var TYPE_NAME $form
     */
    public function index(Request $request, SessionInterface $session): Response
    {
        $form = $this->createForm(BookingType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Booking $booking */
            $booking = $form->getData();

            $ticketsLimit= $booking->getNumberTickets();

            // TODO 1 faire une boucle permettant d'ajouter autant de ticket vide que souhaité par le client
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