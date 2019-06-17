<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Services\Payment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     * @param Request $request
     * @param SessionInterface $session
     * @param Payment $payment
     * @return Response
     */
    public function index(Request $request, SessionInterface $session, Payment $payment): Response
    {
        /** @var Booking $booking */
        $booking = $session->get('booking');


        if ($request->isMethod('POST')) {
            if ($reference = $payment->doPayment($booking->getTotalPrice(), "Billeterie Louvre")) {
                // TODO mettre à jour dans booking la reference
                // TODO enregistrer commande dans la bdd
                // TODO envoyer le mail de confirmation

                //TODO rediger vers la page de confirmation
                return $this->redirectToRoute('order');
            }
        }

        return $this->render("order/index.html.twig", [
            'current_menu' => 'order',
            'booking' => $booking
        ]);
    }

}