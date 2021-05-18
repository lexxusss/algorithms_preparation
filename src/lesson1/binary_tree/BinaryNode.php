<?php

declare(strict_types=1);

class BinaryNode
{
    public int $value;
    public ?self $left;
    public ?self $right;

    public function __construct($item) {
        $this->value = $item;
        $this->left = null;
        $this->right = null;
    }
}
