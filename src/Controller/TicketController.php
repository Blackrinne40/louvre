<?php

namespace App\Controller;

use App\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="ticket")
     * @return Response
     * @var TYPE_NAME $form
     */
    public function index():Response
    {
        $form = $this->createForm(TicketType::class);
        return $this->render('ticket/index.html.twig', [
            'current_menu'=>'ticket',
            'form'=> $form->createView()
        ]);
    }
}