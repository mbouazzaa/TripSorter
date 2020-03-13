<?php


namespace App\exception;


class ExceptionList
{
    public const MISSING_BOARDING_PASS_CODE = 0;
    public const MISSING_BOARDING_PASS_MESSAGE_PLACEHOLDER = "BoardingPass `%s` missing.";

    public const UNKNOWN_BOARDING_PASS_TYPE_CODE = 1;
    public const UNKNOWN_BOARDING_PASS_TYPE_MESSAGE = 'BoardingPass transportation type is unknown.';

    public const MISSING_BOARDING_PASS_TYPE_CODE = 1;
    public const MISSING_BOARDING_PASS_TYPE_MESSAGE = 'BoardingPass transportation type is missing.';

    public const INVALID_SORTED_BOARDING_PASSES_CODE = 2;
    public const INVALID_SORTED_BOARDING_PASSES_MESSAGE = "Sorted Boarding Passes do not contain all passes";

    public const NO_START_DEPARTURE_FOUND_CODE = 3;
    public const NO_START_DEPARTURE_FOUND_MESSAGE = "No starting boarding pass found";

    public const DEPARTURE_NOT_FOUND_CODE = 4;
    public const DEPARTURE_NOT_FOUND_MESSAGE = "Boarding pass not found by departure";
}