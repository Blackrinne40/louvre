<?php

namespace App\Controller;

use App\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    /**
     * @Route("/booking", name="booking")
     * @return Response
     * @var TYPE_NAME $form
     */
    public function index():Response
    {
        $form = $this->createForm(BookingType::class);
        return $this->render('booking/index.html.twig', [
            'current_menu'=>'booking',
            'form'=> $form->createView()
        ]);
    }
}