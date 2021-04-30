<?php

require __DIR__.'/../../vendor/autoload.php';

use Webmozart\Assert\Assert;

function isPalindromic(string $S): bool
{
    $N = strlen($S);
    $M = $N / 2;

    for ($i = 0; $i < $M; $i++) {
        if ($S[$i] !== $S[$N-$i-1]) {
            return false;
        }
    }

    return true;
}

$result = isPalindromic('aba');
Assert::true($result);

$result = isPalindromic('a');
Assert::true($result);

$result = isPalindromic('aa');
Assert::true($result);

$result = isPalindromic('abab');
Assert::false($result);

$result = isPalindromic('ba');
Assert::false($result);

