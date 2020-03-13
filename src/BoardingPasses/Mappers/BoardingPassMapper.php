<?php


namespace App\BoardingPasses\Mappers;


use App\BoardingPasses\BoardingPass;
use App\BoardingPasses\BusPass;
use App\BoardingPasses\Factories\BoardingPassFactory;
use App\BoardingPasses\PlanePass;
use App\BoardingPasses\TrainPass;
use App\BoardingPasses\Validators\BoardingPassValidator;
use App\exception\ExceptionList;
use App\exception\InvalidBoardingPassException;

class BoardingPassMapper
{
    /**
     * @var BoardingPassFactory
     */
    protected $boardingPassFactory;

    /**
     * @var BoardingPassValidator
     */
    protected $boardingPassValidator;

    /**
     * BoardingPassMapper constructor.
     *
     * @param BoardingPassFactory $boardingPassFactory
     */
    public function __construct(
        BoardingPassFactory $boardingPassFactory
    ) {
        $this->boardingPassFactory = $boardingPassFactory;
    }

    /**
     * Map an array to a certain BoardingPassed, based on the transportation type
     * Throw exception if TransportationType key is missing or unknown
     *
     * @param array $boardingPassArray
     *
     * @return BoardingPass
     * @throws InvalidBoardingPassException
     */
    public function mapFromArray(array $boardingPassArray): BoardingPass
    {
        if (true === isset($boardingPassArray[BoardingPass::TRANSPORTATION_TYPE_STRING])) {
            switch ($boardingPassArray[BoardingPass::TRANSPORTATION_TYPE_STRING]) {
                case BusPass::TYPE:
                    $boardingPass = $this->mapBusPassFromArray($boardingPassArray);
                    break;
                case TrainPass::TYPE:
                    $boardingPass = $this->mapTrainPassFromArray($boardingPassArray);
                    break;
                case PlanePass::TYPE:
                    $boardingPass = $this->mapPlanePassFromArray($boardingPassArray);
                    break;
                default:
                    throw new InvalidBoardingPassException(
                        ExceptionList::UNKNOWN_BOARDING_PASS_TYPE_MESSAGE,
                        ExceptionList::UNKNOWN_BOARDING_PASS_TYPE_CODE
                    );
            }
            return $boardingPass;
        }
        throw new InvalidBoardingPassException(
            ExceptionList::MISSING_BOARDING_PASS_TYPE_MESSAGE,
            ExceptionList::MISSING_BOARDING_PASS_TYPE_CODE
        );
    }

    /**
     * Map an array to a BusPass object
     *
     * @param array $boardingPassArray
     *
     * @return BusPass
     * @throws InvalidBoardingPassException
     */
    public function mapBusPassFromArray(array $boardingPassArray): BusPass
    {
        $this->getBoardingPassValidator()->validateBusPassArray($boardingPassArray);
        return $this->boardingPassFactory->buildBusPass(
            $boardingPassArray[BoardingPass::DEPARTURE_STRING],
            $boardingPassArray[BoardingPass::ARRIVAL_STRING],
            $boardingPassArray[BoardingPass::TRANSPORTATION_IDENTIFIER_STRING],
            $boardingPassArray[BoardingPass::TRANSPORTATION_SEAT_ASSIGNMENT_STRING]
        );
    }

    /**
     * Map an array to a TrainPass object
     *
     * @param array $boardingPassArray
     *
     * @return TrainPass
     * @throws InvalidBoardingPassException
     */
    public function mapTrainPassFromArray(array $boardingPassArray): TrainPass
    {
        $this->getBoardingPassValidator()->validateTrainPassArray($boardingPassArray);
        return $this->boardingPassFactory->buildTrainPass(
            $boardingPassArray[BoardingPass::DEPARTURE_STRING],
            $boardingPassArray[BoardingPass::ARRIVAL_STRING],
            $boardingPassArray[BoardingPass::TRANSPORTATION_IDENTIFIER_STRING],
            $boardingPassArray[BoardingPass::TRANSPORTATION_SEAT_ASSIGNMENT_STRING]
        );
    }

    /**
     * Map an array to a PlanePass object
     *
     * @param array $boardingPassArray
     *
     * @return PlanePass
     * @throws InvalidBoardingPassException
     */
    public function mapPlanePassFromArray(array $boardingPassArray): PlanePass
    {
        $this->getBoardingPassValidator()->validatePlanePassArray($boardingPassArray);
        return $this->boardingPassFactory->buildPlanePass(
            $boardingPassArray[BoardingPass::DEPARTURE_STRING],
            $boardingPassArray[BoardingPass::ARRIVAL_STRING],
            $boardingPassArray[BoardingPass::TRANSPORTATION_IDENTIFIER_STRING],
            $boardingPassArray[BoardingPass::TRANSPORTATION_SEAT_ASSIGNMENT_STRING],
            $boardingPassArray[PlanePass::GATE_STRING],
            $boardingPassArray[PlanePass::BAGGAGE_INFORMATION_STRING]
        );
    }

    /**
     * Get an instance of BoardingPassValidator
     *
     * @return BoardingPassValidator
     */
    protected function getBoardingPassValidator(): BoardingPassValidator
    {
        if (false === ($this->boardingPassValidator instanceof BoardingPassValidator)) {
            $this->boardingPassValidator = new BoardingPassValidator();
        }
        return $this->boardingPassValidator;
    }
}