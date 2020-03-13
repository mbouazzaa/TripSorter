<?php


namespace App\contracts;


use App\BoardingPasses\BoardingPassCollection;

interface SorterInterface
{
    /**
     * Sort a boarding pass collection
     *
     * @param BoardingPassCollection $boardingPassCollection
     * @return BoardingPassCollection
     * @throws SortingException
     */
    public function sort(BoardingPassCollection $boardingPassCollection): BoardingPassCollection;
}