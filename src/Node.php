<?php

declare(strict_types=1);

namespace Ilyasakbergen\SortedLinkedList;

class Node
{
    public ?Node $next = null;

    public function __construct(
       public readonly int|string $value,
    ) {
    }
}
