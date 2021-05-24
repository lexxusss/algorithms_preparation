<?php

declare(strict_types=1);

require __DIR__.'/../../../vendor/autoload.php';

use Webmozart\Assert\Assert;


/**
 *
 * Given an integer n, count the total number of digit 1 appearing in all non-negative integers less than or equal to n.

 *
Example 1:

Input: n = 13
Output: 6
 *
 *
Example 2:

Input: n = 0
Output: 0

 * 0-9 = 1
 * 0-99 = 10*1 + 10*1 = 20
 * 0-999 = 10*10 + 10*10 = 200
 * 0-9999 = 10*100 = 10*100 = 2000

 */

function solution(int $n): int
{
    $count = 0;

    for ($i = 1; $i <= $n; $i *= 10) {
        $div = $i * 10;
        $count += (int) ($n / $div) * $i + min(max($n % $div - $i + 1, 0), $i);
    }

    return $count;
}

$result = solution(13);
Assert::eq($result, 6);
$result = solution(0);
Assert::eq($result, 0);



echo "success\n";







