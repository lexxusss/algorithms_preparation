<?php

declare(strict_types=1);

require __DIR__.'/../../../vendor/autoload.php';
require 'BinaryNode.php';

use Webmozart\Assert\Assert;


/**
 * Given the root of a binary search tree, and an integer k, return the kth (1-indexed) smallest element in the tree.

Input: root = [5,3,6,2,4,null,null,1], k = 3
Output: 3

 */

function sortTree(BinaryNode $node, &$values): void
{
    if ($node->left) {
        sortTree($node->left, $values);
    }
    $values[] = $node->value;
    if ($node->right) {
        sortTree($node->right, $values);
    }
}

function solution(BinaryNode $tree, int $k): int
{
    $values = [];

    sortTree($tree, $values);

    return $values[$k-1];
}

$tree = new BinaryNode(5);
$tree->left = new BinaryNode(3);
$tree->right = new BinaryNode(6);
$tree->left->left = new BinaryNode(2);
$tree->left->right = new BinaryNode(4);
$tree->left->left->left = new BinaryNode(1);

$result = solution($tree, 1);
Assert::eq(1, $result);
$result = solution($tree, 2);
Assert::eq(2, $result);
$result = solution($tree, 3);
Assert::eq(3, $result);
$result = solution($tree, 4);
Assert::eq(4, $result);
$result = solution($tree, 5);
Assert::eq(5, $result);

$result = solution($tree, 6);
Assert::eq(6, $result);

echo "success\n";







