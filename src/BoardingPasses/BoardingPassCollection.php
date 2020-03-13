<?php


namespace App\BoardingPasses;


use App\BoardingPasses\BoardingPass;
use App\contracts\ArrayableInterface;
use App\contracts\StringableInterface;

class BoardingPassCollection implements \IteratorAggregate, \Countable, StringableInterface, ArrayableInterface
{
    /**
     * @var string
     */
    protected const MESSAGE_FORMAT = '%d. %s';

    /**
     * @var string
     */
    protected const MESSAGE_LAST = 'You have arrived at your final destination.';

    /**
     * @var array
     */
    protected $storage;

    /**
     * @var string
     */
    protected $iteratorClass;

    /**
     * BoardingPassCollection constructor.
     * @param string $iteratorClass
     */
    public function __construct($iteratorClass = \ArrayIterator::class)
    {
        $this->iteratorClass = $iteratorClass;
    }

    /**
     * Returns the BoardingPass found at the specified offset
     *
     * @param scalar $offset
     * @return null|BoardingPass
     */
    public function get($offset): ?BoardingPass
    {
        if (true === $this->has($offset)) {
            return $this->storage[$offset];
        }
        return null;
    }

    /**
     * Sets a BoardingPass at the specified offset or appends it to the storage
     *
     * @param BoardingPass $boardingPass
     * @param scalar $offset
     */
    public function add(BoardingPass $boardingPass, $offset = null): void
    {
        if (true === is_scalar($offset)) {
            $this->storage[$offset] = $boardingPass;
        } else {
            $this->storage[] = $boardingPass;
        }
    }

    /**
     * Removes the BoardingPass found at a specified offset
     *
     * @param scalar $offset
     */
    public function remove($offset): void
    {
        if (true === $this->has($offset)) {
            unset($this->storage[$offset]);
        }
    }

    /**
     * Checks if a BoardingPass exists at a specified offset
     *
     * @param scalar $offset
     * @return bool
     */
    public function has($offset): bool
    {
        return isset($this->storage[$offset]);
    }

    /**
     * Create a new iterator based on the iteratorClass
     *
     * @return \Iterator
     */
    public function getIterator(): \Iterator
    {
        $class = $this->iteratorClass;
        return new $class($this->storage);
    }

    /**
     * Returns the count of BoardingPasses from the collection
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->storage);
    }

    /**
     * Return the array representation of the Boarding Pass Collection
     * If the boarding pass implements the ArrayableInterface
     * it transforms the BoardingPass to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_map([$this, 'convertToArray'], $this->storage);
    }

    /**
     * Helper method used as callback to transform the collection to an array.
     *
     * @param BoardingPass $value
     * @return array
     */
    protected function convertToArray($value): array
    {
        return ($value instanceof ArrayableInterface ? $value->toArray() : $value);
    }

    /**
     * Return the string representation of the Boarding Pass Collection
     *
     * @return string
     */
    public function __toString(): string
    {
        $destinations = '';
        $no = 1;
        if (true === is_iterable($this->storage)) {
            foreach ($this->storage as $pass) {
                $destinations .= sprintf(self::MESSAGE_FORMAT, $no++, $pass) . PHP_EOL;
            }
        }
        $lastDestination = sprintf(self::MESSAGE_FORMAT, $no++, self::MESSAGE_LAST) . PHP_EOL;
        return $destinations . $lastDestination;
    }

}