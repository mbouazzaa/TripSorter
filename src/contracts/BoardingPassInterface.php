<?php


namespace App\contracts;


interface BoardingPassInterface extends TransportationInterface

{
    /**
     * @var string
     */
    public const DEPARTURE_STRING = 'Departure';

    /**
     * @var string
     */
    public const ARRIVAL_STRING = 'Arrival';

    /**
     * Get departure
     *
     * @return string
     */
    public function getDeparture(): string;

    /**
     * Set departure
     *
     * @param string $departure
     */
    public function setDeparture(string $departure);

    /**
     * Get arrival
     *
     * @return string
     */
    public function getArrival(): string;

    /**
     * Set arrival
     *
     * @param string $arrival
     */
    public function setArrival(string $arrival);

}