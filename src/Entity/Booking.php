<?php

namespace App\Entity;

use App\Validator\NotSunday;
use App\Validator\NotTuesday;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 *
 */
class Booking
{
    const TYPE_DAY = 1;
    const TYPE_HALF_DAY = 0;
    const PRICE_CHILD = 8;
    const AGE_CHILD = 12;
    const PRICE_BABY = 0;
    const AGE_BABY = 4;
    const PRICE_ADULT = 16;
    const AGE_SENIOR = 60;
    const PRICE_SENIOR = 12;
    const PRICE_REDUCT = 10;


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime", length=255)
     *
     */
    private $booking_date;

    /**
     * @ORM\Column(type="date", length=255)
     * @Assert\GreaterThanOrEqual("today", message="not_past_date")
     * @NotTuesday()
     * @NotSunday()
     */
    private $visit_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_tickets;

    /**
     * @ORM\Column(type="smallint")
     */
    private $visit_type;

    /**
     * @ORM\Column(type="float")
     * @var float
     */
    private $totalPrice;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="booking")
     */
    private $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBookingDate(): ?string
    {
        return $this->booking_date;
    }

    public function setBookingDate(string $booking_date): self
    {
        $this->booking_date = $booking_date;

        return $this;
    }

    public function getVisitDate(): ?\DateTime
    {
        return $this->visit_date;
    }

    public function setVisitDate(\DateTime $visit_date): self
    {
        $this->visit_date = $visit_date;

        return $this;
    }

    public function getNumberTickets(): ?int
    {
        return $this->number_tickets;
    }

    public function setNumberTickets(int $number_tickets): self
    {
        $this->number_tickets = $number_tickets;

        return $this;
    }

    public function getVisitType(): ?int
    {
        return $this->visit_type;
    }

    public function getVisitTypeLabel(): string
    {
        return ($this->visit_type == Booking::TYPE_DAY)? "label_day" : "label_half_day";
    }

    public function setVisitType(int $visit_type): self
    {
        $this->visit_type = $visit_type;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setBooking($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->contains($ticket)) {
            $this->tickets->removeElement($ticket);
            // set the owning side to null (unless already changed)
            if ($ticket->getBooking() === $this) {
                $ticket->setBooking(null);
            }
        }

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     * @return Booking
     */
    public function setTotalPrice(float $totalPrice): Booking
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }
}
