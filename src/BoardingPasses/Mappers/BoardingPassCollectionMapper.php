<?php


namespace App\BoardingPasses\Mappers;


use App\BoardingPasses\BoardingPassCollection;
use App\BoardingPasses\Mappers\BoardingPassMapper;
use App\exception\InvalidBoardingPassException;

class BoardingPassCollectionMapper
{
    /**
     * @var BoardingPassMapper
     */
    protected $boardingPassMapper;

    /**
     * BoardingPassCollectionMapper constructor.
     *
     * @param BoardingPassMapper $boardingPassMapper
     */
    public function __construct(
        BoardingPassMapper $boardingPassMapper
    ) {
        $this->boardingPassMapper = $boardingPassMapper;
    }

    /**
     * @param array $boardingPasses
     * @return BoardingPassCollection
     * @throws InvalidBoardingPassException
     */
    public function mapFromArray(array $boardingPasses): BoardingPassCollection
    {
        $boardingPassCollection = $this->buildBoardingPassCollection();
        foreach ($boardingPasses as $boardingPass) {
            $boardingPassCollection->add(
                $this->boardingPassMapper->mapFromArray($boardingPass)
            );
        }
        return $boardingPassCollection;
    }

    /**
     * @return BoardingPassCollection
     */
    protected function buildBoardingPassCollection(): BoardingPassCollection
    {
        return new BoardingPassCollection();
    }
}