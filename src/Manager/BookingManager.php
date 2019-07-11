<?php


namespace App\Manager;


use App\Entity\Booking;
use App\Entity\Ticket;
use App\Services\Mailer;
use App\Services\Payment;
use App\Services\PriceCalculator;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BookingManager
{
    const SESSION_ID = 'booking';

    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var PriceCalculator
     */
    private $priceCalculator;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var Payment
     */
    private $payment;
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * BookingManager constructor.
     * @param SessionInterface $session
     * @param PriceCalculator $priceCalculator
     * @param EntityManagerInterface $entityManager
     * @param Mailer $mailer
     * @param Payment $payment
     */
    public function __construct(
        SessionInterface $session,
        PriceCalculator $priceCalculator,
        EntityManagerInterface $entityManager,
        Mailer $mailer,
        Payment $payment
    )
    {
        $this->session = $session;
        $this->priceCalculator = $priceCalculator;
        $this->entityManager = $entityManager;
        $this->payment = $payment;
        $this->mailer = $mailer;
    }

    public function initBooking(): Booking
    {
        $booking = new Booking();
        $this->session->set(self::SESSION_ID, $booking);

        return $booking;

    }

    /**
     * @param Booking $booking
     * @return Booking
     */
    public function generateTickets(Booking $booking): Booking
    {
        $ticketsLimit = $booking->getNumberTickets();
        for ($i = 1; $i <= $ticketsLimit; $i++) {
            $booking->addTicket(new Ticket());
        }

        return $booking;
    }

    public function doPayment(Booking $booking)
    {

        $reference = $this->payment->doPayment($booking->getTotalPrice(), "Billetterie Louvre");
        if ($reference) {
            $booking->setBookingRef($reference);

            $booking_date = new DateTime();
            $booking->setBookingDate($booking_date);

            $this->entityManager->persist($booking);
            $this->entityManager->flush();

            $this->mailer->sendBookingConfirmation($booking);

            return true;
        }

        return false;
    }

    /**
     * @return Booking
     */
    public function getCurrentBooking(): Booking
    {
        $booking =  $this->session->get(self::SESSION_ID);

        if(!$booking instanceof Booking ){
            throw new NotFoundHttpException();
        }
        return $booking;
    }

    public function computePrice(Booking $booking)
    {
        $this->priceCalculator->computeBookingPrice($booking);
    }

    public function getAndClearCurrentBooking(): Booking
    {
        $booking = $this->getCurrentBooking();
        $this->session->remove(self::SESSION_ID);

        return $booking;

    }
}