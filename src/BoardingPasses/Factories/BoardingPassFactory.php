<?php


namespace App\BoardingPasses\Factories;


use App\BoardingPasses\BusPass;
use App\BoardingPasses\PlanePass;
use App\BoardingPasses\TrainPass;

class BoardingPassFactory
{
    /**
     * Create a new bus pass object from parameters
     *
     * @param string $departure
     * @param string $arrival
     * @param string $transportationIdentifier
     * @param null|string $transportationSeatAssignment
     * @return BusPass
     */
    public function buildBusPass(
        string $departure,
        string $arrival,
        string $transportationIdentifier,
        ?string $transportationSeatAssignment
    ): BusPass {
        return $this->buildEmptyBusPass()
            ->setDeparture($departure)
            ->setArrival($arrival)
            ->setTransportationIdentifier($transportationIdentifier)
            ->setTransportationSeatAssignment($transportationSeatAssignment);
    }

    /**
     * Create a new train pass object from parameters
     *
     * @param string $departure
     * @param string $arrival
     * @param string $transportationIdentifier
     * @param null|string $transportationSeatAssignment
     * @return TrainPass
     */
    public function buildTrainPass(
        string $departure,
        string $arrival,
        string $transportationIdentifier,
        ?string $transportationSeatAssignment
    ): TrainPass {
        return $this->buildEmptyTrainPass()
            ->setDeparture($departure)
            ->setArrival($arrival)
            ->setTransportationIdentifier($transportationIdentifier)
            ->setTransportationSeatAssignment($transportationSeatAssignment);
    }

    /**
     * Create a new plane pass object from parameters
     *
     * @param string $departure
     * @param string $arrival
     * @param string $transportationIdentifier
     * @param null|string $transportationSeatAssignment
     * @param string $gate
     * @param string $baggageInformation
     * @return PlanePass
     */
    public function buildPlanePass(
        string $departure,
        string $arrival,
        string $transportationIdentifier,
        ?string $transportationSeatAssignment,
        string $gate,
        string $baggageInformation
    ): PlanePass {
        return $this->buildEmptyPlanePass()
            ->setDeparture($departure)
            ->setArrival($arrival)
            ->setTransportationIdentifier($transportationIdentifier)
            ->setTransportationSeatAssignment($transportationSeatAssignment)
            ->setGate($gate)
            ->setBaggageInformation($baggageInformation);
    }

    /**
     * Create an new BusPass
     * @return BusPass
     */
    protected function buildEmptyBusPass(): BusPass
    {
        return new BusPass();
    }

    /**
     * Create a new TrainPass
     * @return TrainPass
     */
    protected function buildEmptyTrainPass(): TrainPass
    {
        return new TrainPass();
    }

    /**
     * Create a new PlanePass
     *
     * @return PlanePass
     */
    protected function buildEmptyPlanePass(): PlanePass
    {
        return new PlanePass();
    }
}