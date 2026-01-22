<?php

declare(strict_types=1);

namespace Ilyasakbergen\SortedLinkedList;

class SortedLinkedIntList extends SortedLinkedList
{
    public function __construct(int ...$values)
    {
        foreach ($values as $value) {
            $this->add($value);
        }
    }

    protected function compare(int|string $a, int|string $b): int
    {
        if (!is_int($a) || !is_int($b)) {
            throw new \InvalidArgumentException('Both values must be integers.');
        }

        return $a <=> $b;
    }

    protected function supportsType(int|string $value): bool
    {
        return is_int($value);
    }
}
