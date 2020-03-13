<?php


namespace App\BoardingPasses;


class PlanePass extends BoardingPass
{
    /**
     * @var string
     */
    public const TYPE = 'plane';

    /**
     * @var string
     */
    public const GATE_STRING = 'Gate';

    /**
     * @var string
     */
    public const BAGGAGE_INFORMATION_STRING = 'BaggageInformation';

    /**
     * @var string
     */
    protected const MESSAGE_BASIC_FORMAT = 'From %2$s, take flight %1$s to %3$s. Gate %5$s, %4$s.%7$s%6$s.';

    /**
     * @var string
     */
    protected const MESSAGE_WITH_SEAT = "seat ";

    /**
     * @var string
     */
    protected const MESSAGE_WITHOUT_SEAT = "no seat assignment";

    /**
     * @var string
     */
    protected $gate;

    /**
     * @var string
     */
    protected $baggageInformation;

    /**
     * Get plane boarding pass gate
     *
     * @return string
     */
    public function getGate(): string
    {
        return $this->gate;
    }

    /**
     * Set plane boarding pass gate
     *
     * @param string $gate
     * @return \TripSorter\BoardingPasses\PlanePass
     */
    public function setGate(string $gate): self
    {
        $this->gate = $gate;
        return $this;
    }

    /**
     * Get plane boarding pass baggage information
     *
     * @return string
     */
    public function getBaggageInformation(): string
    {
        return $this->baggageInformation;
    }

    /**
     * Set plane boarding pass baggage information
     *
     * @param string $baggageInformation
     * @return self
     */
    public function setBaggageInformation(string $baggageInformation): self
    {
        $this->baggageInformation = $baggageInformation;
        return $this;
    }

    /**
     * Return the array representation of the Plane Boarding Pass
     *
     * @return array
     */
    public function toArray(): array
    {
        $array = parent::toArray();
        $array[self::GATE_STRING] = $this->getGate();
        $array[self::BAGGAGE_INFORMATION_STRING] = $this->getBaggageInformation();
        return $array;
    }

    /**
     * Return the string representation of the Plane Boarding Pass
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            self::MESSAGE_BASIC_FORMAT,
            $this->getTransportationIdentifier(),
            $this->getDeparture(),
            $this->getArrival(),
            (null != $this->getTransportationSeatAssignment() ?
                self::MESSAGE_WITH_SEAT . $this->getTransportationSeatAssignment() :
                self::MESSAGE_WITHOUT_SEAT
            ),
            $this->getGate(),
            $this->getBaggageInformation(),
            PHP_EOL
        );
    }
}