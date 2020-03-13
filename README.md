# TripSorter
## Installation
To install the project you must have [Composer](https://getcomposer.org/) installed 
and run the command below in the root directory of the project.

```
composer install
```
### Project Dependencies
* PHP: [^7.2](http://php.net/releases/7_2_0.php)

**Note:** The project uses the the composer autoload to load classes.

### Development Dependencies
* [PHPUnit](https://phpunit.de/): ^7
## Usage
### Run the project
To test the project with some predefined values you can run the following command in 
the root directory
```php
php index.php
```
### Code samples
use App\{
    Exceptions\GenericException, SortingAlgorithms\Sorter, Trip
};
use App\BoardingPasses\{
    BoardingPassCollection, Factories\BoardingPassFactory
};

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
} catch (GenericException $e) {
    // treat exception
}
echo PHP_EOL;
```
##### Sample Output
The final string output will be a BoardingPassCollection that implements the magic method 
__toString(), the output will be:

```
1. Take train 78A from Madrid to Barcelona. Sit in seat 45B.
2. Take the airport bus from Barcelona to Gernoa Airport. No seat assignment.
3. From Gernoa Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A.
Baggage drop at ticket counter 344.
4. Take train SK22 from Stockholm to New York JFK. Sit in seat 7B.
5. You have arrived at your final destination.
