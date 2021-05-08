<?php

require __DIR__.'/../../vendor/autoload.php';

use Webmozart\Assert\Assert;

/**
 * Given the heads of two singly linked-lists headA and headB, return the node at which the two lists intersect.
 * If the two linked lists have no intersection at all, return null.
 * It is guaranteed that there are no cycles anywhere in the entire linked structure.
 * Note that the linked lists must retain their original structure after the function returns.
 *
 * Input: intersectVal = 8, listA = [4,1,8,4,5], listB = [5,6,1,8,4,5], skipA = 2, skipB = 3
 * Output: Intersected at '8'
 * Explanation: The intersected node's value is 8 (note that this must not be 0 if the two lists intersect).
 *      From the head of A, it reads as [4,1,8,4,5].
 *      From the head of B, it reads as [5,6,1,8,4,5].
 *      There are 2 nodes before the intersected node in A;
 *      There are 3 nodes before the intersected node in B.
 *
 * @param array $A
 * @param array $B
 * @return int|null
 */


interface iListNode
{
    public function next(): ?self;
    public function value(): int;
}

abstract class ListNode implements iListNode
{
    private int $value;
    protected int $delimiter;
    protected int $limit;

    public function __construct(int $value)
    {
        $this->value = $value;
        $this->initDelimiter();
        $this->initLimit();
    }

    abstract protected function initDelimiter();
    abstract protected function initLimit();

    public function next(): ?self
    {
        $nextVal = (int) floor($this->value / $this->delimiter);
        if ($nextVal > $this->limit) {
            return new static($nextVal);
        }

        return null;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value . '.' . $this->delimiter;
    }
}

class ListNodeA extends ListNode
{
    protected function initDelimiter()
    {
        $this->delimiter = 2;
    }

    protected function initLimit()
    {
        $this->limit = 1;
    }
}

class ListNodeB extends ListNode
{
    protected function initDelimiter()
    {
        $this->delimiter = 2;
    }

    protected function initLimit()
    {
        $this->limit = 1;
    }
}


function solution(iListNode $A, iListNode $B): ?int
{
    $a = clone $A;
    $b = clone $B;

    while ("$a" !== "$b") {
        $a = $a ? $a->next() : $A;
        $b = $b ? $b->next() : $B;
    }

    return $a ? $a->value() : null;
}

$A = new ListNodeA(40); //     40->20->10->5->2
$B = new ListNodeB(80); // 80->40->20->10->5->2
$result = solution($A, $B); // 40
Assert::eq(40, solution($A, $B));
