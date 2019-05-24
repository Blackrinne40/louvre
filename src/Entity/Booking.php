<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
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
     */
    private $booking_date;

    /**
     * @ORM\Column(type="date", length=255)
     */
    private $visit_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_tickets;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $visit_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $confirm_email;

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

    public function getVisitDate(): ?string
    {
        return $this->visit_date;
    }

    public function setVisitDate(string $visit_date): self
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

    public function getVisitType(): ?string
    {
        return $this->visit_type;
    }

    public function setVisitType(string $visit_type): self
    {
        $this->visit_type = $visit_type;

        return $this;
    }

    public function getConfirmEmail(): ?string
    {
        return $this->confirm_email;
    }

    public function setConfirmEmail(string $confirmemail): self
    {
        $this->confirm_email = $confirmemail;

        return $this;
    }
}
