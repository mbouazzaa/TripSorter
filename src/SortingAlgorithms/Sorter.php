<?php


namespace App\SortingAlgorithms;


use App\contracts\SorterInterface;
use App\BoardingPasses\BoardingPass;
use App\BoardingPasses\BoardingPassCollection;
use App\exception\ExceptionList;
use App\exception\GenericException;
use App\exception\SortingException;

class Sorter implements SorterInterface
{
    /**
     * @var BoardingPassCollection
     */
    protected $boardingPassCollectionByDeparture;

    /**
     * @var BoardingPassCollection
     */
    protected $boardingPassCollectionByArrival;

    /**
     * Sort a boarding pass collection
     *
     * @param BoardingPassCollection $boardingPassCollection
     * @return BoardingPassCollection
     * @throws SortingException
     */
    public function sort(BoardingPassCollection $boardingPassCollection): BoardingPassCollection
    {
        $this->indexPassesByDepartureAndArrival($boardingPassCollection);
        $currentLocation = $this->getTripStartDeparture($boardingPassCollection);

        $sortedBoardingPasses = $this->buildBoardingPassCollection();

        do {
            try {
                $currentPass = $this->getBoardingPassByCurrentLocationFromDeparture($currentLocation);
                $sortedBoardingPasses->add($currentPass);
                $currentLocation = $currentPass->getArrival();
            } catch (GenericException $e) {
                break;
            }
        } while ($currentPass);

        $this->validateSortedBoardingPassesContainsAllStops($sortedBoardingPasses, $boardingPassCollection);

        return $sortedBoardingPasses;
    }

    /**
     * Index boarding passes into two proprieties by Departure and Arrival
     *
     * @param $boardingPasseCollection
     */
    protected function indexPassesByDepartureAndArrival(BoardingPassCollection $boardingPasseCollection): void
    {
        $this->boardingPassCollectionByDeparture = $this->buildBoardingPassCollection();
        $this->boardingPassCollectionByArrival = $this->buildBoardingPassCollection();

        /** @var BoardingPass $boardingPass */
        foreach ($boardingPasseCollection as $boardingPass) {
            $this->boardingPassCollectionByDeparture->add($boardingPass, $boardingPass->getDeparture());
            $this->boardingPassCollectionByArrival->add($boardingPass, $boardingPass->getArrival());
        }
    }

    /**
     * Ge the starting point (departure) of the trip
     *
     * @param BoardingPassCollection $boardingPasses
     * @return string
     * @throws SortingException
     */
    protected function getTripStartDeparture(BoardingPassCollection $boardingPasses): string
    {
        /** @var BoardingPass $boardingPass */
        foreach ($boardingPasses as $boardingPass) {
            if (false === $this->boardingPassCollectionByArrival->has($boardingPass->getDeparture())) {
                return $boardingPass->getDeparture();
            }
        }
        throw new SortingException(
            ExceptionList::NO_START_DEPARTURE_FOUND_MESSAGE,
            ExceptionList::NO_START_DEPARTURE_FOUND_CODE
        );
    }

    /**
     * Get the boarding pass by location
     *
     * @param string $departureLocation
     * @return BoardingPass
     * @throws SortingException
     */
    protected function getBoardingPassByCurrentLocationFromDeparture(string $departureLocation): BoardingPass
    {
        if (false === $this->boardingPassCollectionByDeparture->has($departureLocation)) {
            throw new SortingException(
                ExceptionList::DEPARTURE_NOT_FOUND_MESSAGE,
                ExceptionList::DEPARTURE_NOT_FOUND_CODE
            );
        }
        return $this->boardingPassCollectionByDeparture->get($departureLocation);
    }

    /**
     * Validate that the sorted boarding passes count
     * is equal to the sent boarding passes to sort
     *
     * @param BoardingPassCollection $sortedBoardingPasses
     * @param BoardingPassCollection $boardingPassCollection
     * @throws SortingException
     */
    protected function validateSortedBoardingPassesContainsAllStops(
        BoardingPassCollection $sortedBoardingPasses,
        BoardingPassCollection $boardingPassCollection
    ) {
        if (count($sortedBoardingPasses) !== count($boardingPassCollection)) {
            throw new SortingException(
                ExceptionList::INVALID_SORTED_BOARDING_PASSES_MESSAGE,
                ExceptionList::INVALID_SORTED_BOARDING_PASSES_CODE
            );
        }
    }

    /**
     * Create an instance of BoardingPassCollection
     *
     * @return BoardingPassCollection
     */
    protected function buildBoardingPassCollection()
    {
        return new BoardingPassCollection();
    }
}