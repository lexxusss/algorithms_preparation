<?php

declare(strict_types=1);

require __DIR__.'/../../../vendor/autoload.php';

use Webmozart\Assert\Assert;


/**
 *
 * A password is considered strong if the below conditions are all met:

It has at least 6 characters and at most 20 characters.
 * It contains at least one lowercase letter,
 * at least one uppercase letter,
 * and at least one digit.
 * It does not contain three repeating characters in a row
 * (i.e., "...aaa..." is weak, but "...aa...a..." is strong, assuming other conditions are met).

Given a string password, return the minimum number of steps required to make password strong. if password is already strong, return 0.

In one step, you can:

Insert one character to password, Delete one character from password, or Replace one character of password with another character.

Example 1:

Input: password = "a"
Output: 5
Example 2:

Input: password = "aA1"
Output: 3
Example 3:

Input: password = "1337C0d3"
Output: 0
7

 */


function countRepeatingNumbers(string $string): int
{
    $N = strlen($string);

    $totalR = 0;
    $currentR = 0;
    for ($i = 0; $i < $N; $i++) {
        $char = $string[$i];
        $prevChar = $string[$i-1] ?? null;

        if ($char === $prevChar) {
            $currentR++;

            if ($currentR > 2) {
                $totalR++;
                $currentR = 0;
            }
        } else {
            $currentR = 0;
        }
    }

    return $totalR;
}

function solution(string $password): int
{
    $min = 6;
    $max = 20;

    $N = strlen($password);

    $inserts = max(0, $min - $N);
    $replaces = (int) !preg_match('/[A-Z]/', $password)
        + (int) !preg_match('/[a-z]/', $password)
        + (int) !preg_match('/[0-9]/', $password);
    $deletes = max($N - $max, 0);
    $repeatReplaces = countRepeatingNumbers($password);

    if (!$deletes) {
        return max($inserts, $replaces, $repeatReplaces);
    }

    return max($inserts, $replaces) + max($deletes, $repeatReplaces);
}

$result = solution('aaaaaa'); // [2]: replace 1x`a` with U/letter + replace 1x`a` with L/letter
Assert::eq($result, 2);
$result = solution('a');
Assert::eq($result, 5);
$result = solution('aA1');
Assert::eq($result, 3);
$result = solution('1337C0d3');
Assert::eq($result, 0);
$result = solution('1333aBcDeF1234aBcDeFg'); // 21 chars, repeating `3` x three times: actions: [1] - remove one `3`
Assert::eq($result, 1);
$result = solution('12345678901234567890123'); // 23 chars, UpperCase/LowerCase are missed, length overflowed, actions: [5] - remove 3 chars + replace 2 chars with UpperCase/Lowercase letters
Assert::eq($result, 5);
$result = solution('123'); // 3 chars, UpperCase/LowerCase are missed, length is not enough, actions: [3] - add 3 chars with UpperCase/Lowercase letters
Assert::eq($result, 3);
$result = solution('22222'); // 3 chars, UpperCase/LowerCase are missed, length is not enough, 3xchars, actions: [2] - 1 replace "2" with U/L letter + add 1 char with L/U letters
Assert::eq($result, 2);


echo "success\n";







