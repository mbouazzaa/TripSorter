<?php


namespace App\BoardingPasses;


class TrainPass extends BoardingPass
{
    /**
     * @var string
     */
    public const TYPE = 'train';

    /**
     * @var string
     */
    protected const MESSAGE_BASIC_FORMAT = 'Take train %1$s from %2$s to %3$s. %4$s.';

    /**
     * @var string
     */
    protected const MESSAGE_WITH_SEAT = "Sit in seat ";

}