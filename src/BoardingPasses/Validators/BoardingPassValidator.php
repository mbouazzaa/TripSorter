<?php


namespace App\BoardingPasses\Validators;


use App\BoardingPasses\BoardingPass;
use App\BoardingPasses\PlanePass;
use App\exception\ExceptionList;
use App\Exception\InvalidBoardingPassException;

class BoardingPassValidator
{
    protected const REQUIRED_KEYS = [
        BoardingPass::DEPARTURE_STRING,
        BoardingPass::ARRIVAL_STRING,
        BoardingPass::TRANSPORTATION_IDENTIFIER_STRING
    ];

    protected const PLANE_REQUIRED_KEYS = [
        PlanePass::GATE_STRING,
        PlanePass::BAGGAGE_INFORMATION_STRING
    ];

    /**
     * Validate the bus pass array structure
     *
     * @param array $boardingPassArray
     * @throws InvalidBoardingPassException
     */
    public function validateBusPassArray(array $boardingPassArray)
    {
        $this->validateGenericPassData($boardingPassArray);
    }

    /**
     * Validate the train pass array structure
     *
     * @param array $boardingPassArray
     * @throws InvalidBoardingPassException
     */
    public function validateTrainPassArray(array $boardingPassArray)
    {
        $this->validateGenericPassData($boardingPassArray);
    }

    /**
     * Validate the plane pass array structure
     *
     * @param array $boardingPassArray
     * @throws InvalidBoardingPassException
     */
    public function validatePlanePassArray(array $boardingPassArray)
    {
        $this->validateGenericPassData($boardingPassArray);

        foreach (self::PLANE_REQUIRED_KEYS as $requiredKey) {
            $this->validateRequiredAttributeAreSet($boardingPassArray, $requiredKey);
        }
    }

    /**
     *  Validate the generic boarding pass array structure
     *
     * @param array $boardingPassArray
     * @throws InvalidBoardingPassException
     */
    public function validateGenericPassData(array $boardingPassArray)
    {
        foreach (self::REQUIRED_KEYS as $requiredKey) {
            $this->validateRequiredAttributeAreSet($boardingPassArray, $requiredKey);
        }
        $this->validateAttributeExists($boardingPassArray, BoardingPass::TRANSPORTATION_SEAT_ASSIGNMENT_STRING);
    }

    /**
     * Validate the required boarding pass array structure
     *
     * @param array $boardingPassArray
     * @param string $attribute
     * @throws InvalidBoardingPassException
     */
    protected function validateRequiredAttributeAreSet(array $boardingPassArray, string $attribute): void
    {
        if (false === isset($boardingPassArray[$attribute])) {
            throw new InvalidBoardingPassException(
                sprintf(ExceptionList::MISSING_BOARDING_PASS_MESSAGE_PLACEHOLDER, $attribute),
                ExceptionList::MISSING_BOARDING_PASS_CODE
            );
        }
    }

    /**
     * Validate that the attribute/propriety boarding pass array structure
     *
     * @param array $boardingPassArray
     * @param string $attribute
     * @throws InvalidBoardingPassException
     */
    protected function validateAttributeExists(array $boardingPassArray, string $attribute): void
    {
        if (false === array_key_exists($attribute, $boardingPassArray)) {
            throw new InvalidBoardingPassException(
                sprintf(ExceptionList::MISSING_BOARDING_PASS_MESSAGE_PLACEHOLDER, $attribute),
                ExceptionList::MISSING_BOARDING_PASS_CODE
            );
        }
    }
}