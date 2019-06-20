<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmationController extends AbstractController
{
    /**
     * @Route("/confirmation", name="confirmation")
     * @param SessionInterface $session
     * @return Response
     */
    public function index(SessionInterface $session):Response
    {
        if($session->has('booking') === true) {
            $booking = $session->get('booking');


            return $this->render("order/confirmation.html.twig", [
                'current_menu' => 'confirmation',
                'booking' => $booking
            ]);
        }
    }
}