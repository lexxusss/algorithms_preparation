<?php

require __DIR__.'/../../../vendor/autoload.php';

use Webmozart\Assert\Assert;

/**
 * Given an integer array nums, find a peak element, and return its index. If the array contains multiple peaks, return the index to any of the peaks.

You may imagine that nums[-1] = nums[n] = -∞.

Example:

Input: nums = [1,2,3,1]
Output: 2
Explanation: 3 is a peak element and your function should return the index number 2.
 * @param array $intervals
 * @return array
 */

function solution(array $array): int
{
    static $k;
    foreach ($array as $k => $value) {
        if ($value >= $array[$k+1]) {
            return $k;
        }
    }

    return $k;
}

$array = [1,2,3,1];
$result = solution($array);
Assert::eq(2, $result);

$array = [1,2,1,3,5,6,4];
$result = solution($array);
Assert::inArray($result, [1, 5]);
