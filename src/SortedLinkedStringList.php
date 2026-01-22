<?php

declare(strict_types=1);

namespace Ilyasakbergen\SortedLinkedList;

class SortedLinkedStringList extends SortedLinkedList
{
    public function __construct(string ...$values)
    {
        foreach ($values as $value) {
            $this->add($value);
        }
    }

    protected function compare(int|string $a, int|string $b): int
    {
        if (!is_string($a) || !is_string($b)) {
            throw new \InvalidArgumentException('Both values must be strings.');
        }

        return strcmp($a, $b);
    }

    protected function supportsType(int|string $value): bool
    {
        return is_string($value);
    }
}
