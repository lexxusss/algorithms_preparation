<?php

declare(strict_types=1);

require __DIR__.'/../../../vendor/autoload.php';

use Webmozart\Assert\Assert;


/**
 *
 * Winter is coming! During the contest,
 * your first job is to design a standard heater with a fixed warm radius to warm all the houses.

Every house can be warmed, as long as the house is within the heater's warm radius range.

Given the positions of houses and heaters on a horizontal line,
 * return the minimum radius standard of heaters so that those heaters could cover all houses.

Notice that all the heaters follow your radius standard, and the warm radius will the same.

 *
 *
Example 1:

Input: houses = [1,2,3], heaters = [2]
Output: 1
Explanation: The only heater was placed in the position 2,
 * and if we use the radius 1 standard, then all the houses can be warmed.
 *
 *
Example 2:

Input: houses = [1,2,3,4], heaters = [1,4]
Output: 1
Explanation: The two heater was placed in the position 1 and 4.
 * We need to use radius 1 standard, then all the houses can be warmed.
 *
 *
Example 3:

Input: houses = [1,5], heaters = [2]
Output: 3

 */

function solution(array $houses, array $heaters): int
{
    $maxGap = 0;
    foreach ($heaters as $h => $heater) {
        $gap = 0;
        while (($house = array_shift($houses)) && $house <= $heater) {
            $gap = max($gap, $heater - $house);
        }

        $maxGap = max($maxGap, $gap);
    }

    $lastHouse = array_pop($houses) ?: ($house ?? null);
    $lastHeater = $heater ?? 0;
    if ($lastHouse && $lastHeater) {
        $gap = $lastHouse - $lastHeater;
        $maxGap = max($maxGap, $gap);
    }

    return $maxGap;
}

$result = solution([1,2,3], [2]);
Assert::eq($result, 1);
$result = solution([1,2,3,4], [1,4]);
Assert::eq($result, 1);
$result = solution([1,5], [2]);
Assert::eq($result, 3);
$result = solution([1,5], [2]);
Assert::eq($result, 3);



echo "success\n";







