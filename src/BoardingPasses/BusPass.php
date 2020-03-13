<?php


namespace App\BoardingPasses;


class BusPass extends BoardingPass
{
    /**
     * @var string
     */
    public const TYPE = 'bus';

    /**
     * @var string
     */
    protected const MESSAGE_BASIC_FORMAT = 'Take the %1$s bus from %2$s to %3$s. %4$s.';

    /**
     * @var string
     */
    protected const MESSAGE_WITH_SEAT = "Seat ";
}