<?php

require __DIR__.'/../../../vendor/autoload.php';
require __DIR__.'is_palindromic.php';

use Webmozart\Assert\Assert;

/**
 * Given a string s, return the longest palindromic substring in s.
 *
 * @param string $S
 * @return string
 */
function solution(string $S): string
{
    $N = strlen($S);
    $max = 0;
    $s = '';

    for ($i = 0; $i < $N; $i++) {
        for ($j = $i; $j < $N; $j++) {
            $substr = substr($S, $i, $N-$j);
            $m = strlen($substr);

            if ($m > $max && isPalindromic($substr)) {
                $s = $substr;
                $max = $m;
            }
        }
    }

    return $s;
}

$result = solution('babad');
Assert::inArray($result, ['bab', 'aba']);

$result = solution('cbbd');
Assert::inArray($result, ['bb']);

$result = solution('a');
Assert::inArray($result, ['a']);

$result = solution('ac');
Assert::inArray($result, ['a', 'c']);
