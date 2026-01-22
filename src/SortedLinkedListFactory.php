<?php

declare(strict_types=1);

namespace Ilyasakbergen\SortedLinkedList;

class SortedLinkedListFactory
{

    public static function createForStrings(string ...$values): SortedLinkedStringList
    {
        return new SortedLinkedStringList(...$values);
    }

    public static function createForInts(int ...$values): SortedLinkedIntList
    {
        return new SortedLinkedIntList(...$values);
    }
}
