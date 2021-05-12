<?php

require __DIR__.'/../../../vendor/autoload.php';
require __DIR__.'/could_be_merged.php';

use Webmozart\Assert\Assert;

/**
 * Given an array of intervals where intervals[i] = [starti, endi], merge all overlapping intervals, and return an array of the non-overlapping intervals that cover all the intervals in the input.

Example:

Input: intervals = [[1,3],[2,6],[8,10],[15,18]]
Output: [[1,6],[8,10],[15,18]]
Explanation: Since intervals [1,3] and [2,6] overlaps, merge them into [1,6]./**
 * @param array $intervals
 * @return array
 */

function solution(array $intervals): array
{
    usort($intervals, static function($intervalA, $intervalB) {
        return $intervalA[0] <=> $intervalB[0];
    });

    $current = array_shift($intervals);
    $result = [$current];
    while ($next = array_shift($intervals)) {
        if (couldBeMerged($current, $next)) {
            $current = [$current[0], max($next[1], $current[1])];
            array_pop($result);
            array_push($result, $current);
        } else {
            array_push($result, $next);
        }
    }

    return $result;
}

$intervals = [[1,3],[2,6],[8,10],[15,18]];
$result = solution($intervals);
Assert::eq([[1,6],[8,10],[15,18]], $result);

$intervals = [[1,6],[15,18],[2,3],[8,10]];
$result = solution($intervals);
Assert::eq([[1,6],[8,10],[15,18]], $result);
