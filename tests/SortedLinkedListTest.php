<?php

declare(strict_types=1);

namespace Ilyasakbergen\SortedLinkedList\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * It should be able to hold string or int values, but not both
 */
final class SortedLinkedListTest extends TestCase
{
    #[Test]
    public function it_can_hold_string_values(): void
    {
        $list = \Ilyasakbergen\SortedLinkedList\SortedLinkedList::createForStrings();
        $list->add('Iliyas');
        $list->add('Akbergen');

        self::assertSame(['Akbergen', 'Iliyas'], $list->toArray());
    }

    #[Test]
    public function it_can_hold_int_values(): void
    {
        $list = \Ilyasakbergen\SortedLinkedList\SortedLinkedList::createForInts();
        $list->add(5);
        $list->add(2);

        self::assertSame([2, 5], $list->toArray());
    }

    #[Test]
    public function string_list_cannot_hold_int_values(): void
    {
        self::expectException(\InvalidArgumentException::class);

        $list = \Ilyasakbergen\SortedLinkedList\SortedLinkedList::createForStrings();
        $list->add(5);
    }

    #[Test]
    public function int_list_cannot_hold_int_values(): void
    {
        self::expectException(\InvalidArgumentException::class);

        $list = \Ilyasakbergen\SortedLinkedList\SortedLinkedList::createForInts();
        $list->add('Iliyas');
    }

    #[Test]
    public function it_can_hold_duplicate_values(): void
    {
        $list = \Ilyasakbergen\SortedLinkedList\SortedLinkedList::createForInts();
        $list->add(5);
        $list->add(2);
        $list->add(5);

        self::assertSame([2, 5, 5], $list->toArray());
    }

    #[Test]
    public function it_can_remove_values(): void
    {
        $list = \Ilyasakbergen\SortedLinkedList\SortedLinkedList::createForInts();
        $list->add(5);
        $list->add(2);
        $list->add(5);
        $list->remove(5);

        self::assertSame([2, 5], $list->toArray());
    }

    #[Test]
    public function it_keeps_values_sorted(): void
    {
        $list = \Ilyasakbergen\SortedLinkedList\SortedLinkedList::createForInts();
        $list->add(10);
        $list->add(1);
        $list->add(5);
        $list->remove(10);
        $list->add(3);

        self::assertSame([1, 3, 5], $list->toArray());

        $listStrings = \Ilyasakbergen\SortedLinkedList\SortedLinkedList::createForStrings();
        $listStrings->add('test');
        $listStrings->add('Iliyas');
        $listStrings->add('Akbergen');
        $listStrings->add('Zhanakhmetuly');
        $listStrings->remove('test');
        self::assertSame(['Akbergen', 'Iliyas', 'Zhanakhmetuly'], $listStrings->toArray());
    }

    #[Test]
    public function it_can_check_if_value_exists(): void
    {
        $list = \Ilyasakbergen\SortedLinkedList\SortedLinkedList::createForInts();
        $list->add(5);
        $list->add(2);

        self::assertTrue($list->contains(5));
        self::assertFalse($list->contains(10));

        $listStrings = \Ilyasakbergen\SortedLinkedList\SortedLinkedList::createForStrings();
        $listStrings->add('Iliyas');
        $listStrings->add('Akbergen');
        self::assertTrue($listStrings->contains('Akbergen'));
        self::assertFalse($listStrings->contains('test'));
    }

    #[Test]
    public function it_can_get_size_of_list(): void
    {
        $list = \Ilyasakbergen\SortedLinkedList\SortedLinkedList::createForInts();
        self::assertSame(0, $list->size());

        $list->add(5);
        $list->add(2);
        self::assertSame(2, $list->size());

        $list->remove(5);
        self::assertSame(1, $list->size());
    }

    #[Test]
    public function removing_non_existent_value_does_nothing(): void
    {
        $list = \Ilyasakbergen\SortedLinkedList\SortedLinkedList::createForInts();
        $list->add(5);
        $list->add(2);
        $list->remove(10);

        self::assertSame([2, 5], $list->toArray());
    }
}
