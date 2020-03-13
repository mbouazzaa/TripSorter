<?php


namespace App\BoardingPasses;


use App\contracts\ArrayableInterface;
use App\contracts\BoardingPassInterface;
use App\contracts\StringableInterface;
use App\contracts\TransportationInterface;

abstract class BoardingPass implements  BoardingPassInterface,ArrayableInterface,StringableInterface
{
    /**
     * @var string
     */
    protected const MESSAGE_WITHOUT_SEAT = "No seat assignment";

    /**
     * @var string 
     */
    protected const MESSAGE_WITH_SEAT = "Seat ";

    /**
     * @var string
     */
    protected $departure;

    /**
     * @var string
     */
    protected $arrival;

    /**
     * @var string
     */
    protected $transportationIdentifier;

    /**
     * @var null|string
     */
    protected $transportationSeatAssignment;

    /**
     * Get departure
     *
     * @return string
     */
    public function getDeparture(): string
    {
        return $this->departure;
    }

    /**
     * Set departure
     *
     * @param string $departure
     * @return \TripSorter\BoardingPasses\BoardingPass
     */
    public function setDeparture(string $departure): self
    {
        $this->departure = $departure;
        return $this;
    }

    /**
     * Get arrival
     *
     * @return string
     */
    public function getArrival(): string
    {
        return $this->arrival;
    }

    /**
     * Set arrival
     *
     * @param string $arrival
     * @return self
     */
    public function setArrival(string $arrival): self
    {
        $this->arrival = $arrival;
        return $this;
    }

    /**
     * Get transportation identifier
     *
     * @return string
     */
    public function getTransportationIdentifier(): string
    {
        return $this->transportationIdentifier;
    }

    /**
     * Set transportation identifier
     *
     * @param string $transportationIdentifier
     * @return self
     */
    public function setTransportationIdentifier(string $transportationIdentifier): self
    {
        $this->transportationIdentifier = $transportationIdentifier;
        return $this;
    }

    /**
     * Get Transportation seat assignment. (may be null)
     *
     * @return null|string
     */
    public function getTransportationSeatAssignment(): ?string
    {
        return $this->transportationSeatAssignment;
    }

    /**
     * Set transportation seat assignment. (may be null)
     *
     * @param null|string $transportationSeatAssignment
     * @return self
     */
    public function setTransportationSeatAssignment(?string $transportationSeatAssignment): self
    {
        $this->transportationSeatAssignment = $transportationSeatAssignment;
        return $this;
    }

    /**
     * Return the string representation of the BoardingPass
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            static::MESSAGE_BASIC_FORMAT,
            $this->getTransportationIdentifier(),
            $this->getDeparture(),
            $this->getArrival(),
            (null != $this->getTransportationSeatAssignment() ?
                static::MESSAGE_WITH_SEAT . $this->getTransportationSeatAssignment() :
                static::MESSAGE_WITHOUT_SEAT
            )
        );
    }

    /**
     * Return the array representation of the Boarding Pass
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            self::DEPARTURE_STRING => $this->getDeparture(),
            self::ARRIVAL_STRING => $this->getArrival(),
            self::TRANSPORTATION_IDENTIFIER_STRING => $this->getTransportationIdentifier(),
            self::TRANSPORTATION_SEAT_ASSIGNMENT_STRING => $this->getTransportationSeatAssignment(),
            self::TRANSPORTATION_TYPE_STRING => static::TYPE
        ];
    }

}