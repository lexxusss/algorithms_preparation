<?php

require __DIR__.'/../../../vendor/autoload.php';

use Webmozart\Assert\Assert;

function couldBeMerged(array $arrLow, array $arrHigh): bool
{
    return $arrLow[1] >= $arrHigh[0] - 1;
}

$result = couldBeMerged([1,3], [2,6]);
Assert::true($result);

$result = couldBeMerged([1,6], [2,3]);
Assert::true($result);

$result = couldBeMerged([1,2], [3,6]);
Assert::true($result);

$result = couldBeMerged([2,8], [4,6]);
Assert::true($result);

$result = couldBeMerged([1,3], [3,6]);
Assert::true($result);

$result = couldBeMerged([1,2], [4,6]);
Assert::false($result);

