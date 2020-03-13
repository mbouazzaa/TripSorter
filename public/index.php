<?php

use App\BoardingPasses\BoardingPassCollection;
use App\BoardingPasses\Factories\BoardingPassFactory;
use App\exception\GenericException;
use App\SortingAlgorithms\Sorter;
use App\Trip;

require_once __DIR__ . '/../vendor/autoload.php';

$boardingPassFactory = new BoardingPassFactory();
$trainPassFromFactory = $boardingPassFactory->buildTrainPass(
    "Madrid",
    "Barcelona",
    "78A",
    "45B"
);
$busPassFromFactory = $boardingPassFactory->buildBusPass(
    "Barcelona",
    "Gernoa Airport",
    "airport",
    null
);
$planePassFromFactory = $boardingPassFactory->buildPlanePass(
    "Gernoa Airport",
    "Stockholm",
    "SK455",
    "3A",
    "45B",
    "Baggage drop at ticket counter 344"
);
$planePass1FromFactory1 = $boardingPassFactory->buildTrainPass(
    "Stockholm",
    "New York JFK",
    "SK22",
    "7B",
    "22",
    "Baggage will we automatically transferred from your last leg"
);

$boardingPassCollection = new BoardingPassCollection();
$boardingPassCollection->add($trainPassFromFactory, 0);
$boardingPassCollection->add($busPassFromFactory);
$boardingPassCollection->add($planePass1FromFactory1);
$boardingPassCollection->add($planePassFromFactory);

$sorter = new Sorter();
$tripSorter = new Trip($sorter, $boardingPassCollection);
try {
    $sortedBoardingPassCollection = $tripSorter->sortBoardingPasses();
    echo "Trip (1)" . PHP_EOL . $sortedBoardingPassCollection;
} catch (GenericException $e) {
    // treat exception
}
echo PHP_EOL;
// or
$boardingPassCollection = new BoardingPassCollection();
$boardingPassCollection->add($trainPassFromFactory, 0);
$boardingPassCollection->add($busPassFromFactory);
$boardingPassCollection->add($planePass1FromFactory1);
$boardingPassCollection->add($planePassFromFactory);

$sorter = new Sorter();
$tripSorter = new Trip($sorter);
$tripSorter->setBoardingPasses($boardingPassCollection);
try {
    $sortedBoardingPassCollection = $tripSorter->sortBoardingPasses();
    echo "Trip (2)" . PHP_EOL . $sortedBoardingPassCollection;
} catch (GenericException $e) {
    // treat exception
}
echo PHP_EOL;
