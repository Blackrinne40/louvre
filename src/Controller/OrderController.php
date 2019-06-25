<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Manager\BookingManager;
use App\Services\Payment;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Image;
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
     * @param BookingManager $bookingManager
     * @return Response
     */
    public function index(Request $request, BookingManager $bookingManager): Response
    {
        $booking = $bookingManager->getCurrentBooking();

        if ($request->isMethod('POST')) {
            if($bookingManager->doPayment($booking)){
                return $this->redirectToRoute('confirmation');
            }

            $this->addFlash('danger', "flash.payment.failed");

        }

        return $this->render("order/index.html.twig", ['current_menu' => 'order',
            'booking' => $booking]);
    }

}