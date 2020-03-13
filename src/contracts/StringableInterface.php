<?php


namespace App\contracts;


interface StringableInterface
{
    /**
     * @return string
     */
    public function __toString(): string;
}