<?php


namespace App\Services;


use App\Entity\Booking;
use Swift_Image;
use Twig\Environment;

class Mailer
{

    /**
     * @var Environment
     */
    private $environment;
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(Environment $environment, \Swift_Mailer $mailer)
    {
        $this->environment = $environment;
        $this->mailer = $mailer;
    }

    public function sendBookingConfirmation(Booking $booking)
    {
        $message = (new \Swift_Message('Vos billets pour le Louvre'))
            ->setFrom('formationcpm-projets@outlook.fr')
            ->setTo($booking->getEmail());
        $cid = $message->embed(Swift_Image::fromPath('img/logo-homepage.png'));
        $message
            ->setBody(
                $this->environment->render(
                    'emails/tickets.html.twig',
                    [
                        'booking' => $booking,
                        'cid' => $cid
                    ]
                ),
                'text/html'
            );

        return $this->mailer->send($message);
    }
}