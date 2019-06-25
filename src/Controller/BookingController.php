<?php

namespace App\Controller;

use App\Form\BookingType;
use App\Manager\BookingManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    /**
     * @Route("/booking", name="booking")
     * @param Request $request
     * @param BookingManager $bookingManager
     * @return Response
     */
    public function index(Request $request, BookingManager $bookingManager): Response
    {
        $form = $this->createForm(BookingType::class, $bookingManager->initBooking());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $bookingManager->generateTickets($form->getData());
            return $this->redirectToRoute('ticket');
        }

        return $this->render('booking/index.html.twig', [
            'current_menu' => 'booking',
            'form' => $form->createView()
        ]);
    }
}