<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Services\Payment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     * @param Request $request
     * @param SessionInterface $session
     * @param Payment $payment
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(Request $request, SessionInterface $session, Payment $payment, EntityManagerInterface $entityManager): Response
    {
        /** @var Booking $booking */
        $booking = $session->get('booking');

        if ($request->isMethod('POST')) {
            if ($reference = $payment->doPayment($booking->getTotalPrice(), "Billeterie Louvre")) {
                $booking->setBookingRef($reference);

                $booking_date =new DateTime();
                $booking->setBookingDate($booking_date);
                // TODO enregistrer commande dans la bdd
                $entityManager = $this-> getDoctrine()->getManager();
                $entityManager->persist($booking);
                $entityManager->flush();

                // TODO envoyer le mail de confirmation


                //TODO rediger vers la page de confirmation
                $session->set('booking', $booking);
                return $this->redirectToRoute('confirmation');
            }
        }

        return $this->render("order/index.html.twig", [
            'current_menu' => 'order',
            'booking' => $booking
        ]);
    }

}