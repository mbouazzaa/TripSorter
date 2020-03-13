<?php


namespace App\contracts;


interface TransportationInterface
{
    public const TRANSPORTATION_IDENTIFIER_STRING = 'TransportationIdentifier';
    public const TRANSPORTATION_SEAT_ASSIGNMENT_STRING = 'TransportationSeatAssignment';
    public const TRANSPORTATION_TYPE_STRING = 'TransportationType';

    /**
     * Get transportation identifier
     *
     * @return string
     */
    public function getTransportationIdentifier(): string;

    /**
     * Set transportation identifier
     *
     * @param string $transportationIdentifier
     */
    public function setTransportationIdentifier(string $transportationIdentifier);

    /**
     * Get Transportation seat assignment. (may be null)
     *
     * @return null|string
     */
    public function getTransportationSeatAssignment(): ?string;

    /**
     * Set transportation seat assignment. (may be null)
     *
     * @param null|string $transportationSeatAssignment
     */
    public function setTransportationSeatAssignment(?string $transportationSeatAssignment);
}