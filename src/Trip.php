<?php


namespace App;


use App\BoardingPasses\BoardingPassCollection;
use App\Contracts\SorterInterface;

class Trip
{
    /**
     * @var SorterInterface
     */
    protected $sorter;

    /**
     * @var null|BoardingPassCollection
     */
    protected $boardingPasses = null;

    /**
     * Trip constructor.
     *
     * @param SorterInterface $sorter
     * @param null|BoardingPassCollection $boardingPasses
     */
    public function __construct(
        SorterInterface $sorter,
        ?BoardingPassCollection $boardingPasses = null
    ) {
        $this->setSorter($sorter);
        $this->setBoardingPasses($boardingPasses);
    }

    /**
     * Get Boarding Pass Collection
     *
     * @return null|BoardingPassCollection
     */
    public function getBoardingPasses(): ?BoardingPassCollection
    {
        return $this->boardingPasses;
    }

    /**
     * Set Boarding Pass Collection
     *
     * @param null|BoardingPassCollection $boardingPasses
     * @return \TripSorter\Trip
     */
    public function setBoardingPasses(?BoardingPassCollection $boardingPasses): self
    {
        $this->boardingPasses = $boardingPasses;
        return $this;
    }

    /**
     * Sort the boarding passes
     *
     * @return BoardingPassCollection
     */
    public function sortBoardingPasses(): BoardingPassCollection
    {
        $passes = $this->getBoardingPasses();

        if (1 < count($passes)) {
            $passes = $this->getSorter()->sort($passes);
        }
        return $passes;
    }

    /**
     * Get the sorting algorithm
     *
     * @return SorterInterface
     */
    public function getSorter(): SorterInterface
    {
        return $this->sorter;
    }

    /**
     * Set the sorting algorithm
     *
     * @param SorterInterface $sorter
     * @return Trip
     */
    public function setSorter(SorterInterface $sorter): self
    {
        $this->sorter = $sorter;
        return $this;
    }
}