<?php

declare(strict_types=1);

namespace Ilyasakbergen\SortedLinkedList\Tests;

use Ilyasakbergen\SortedLinkedList\SortedLinkedListFactory;
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
        $list = SortedLinkedListFactory::createForStrings();
        $list->add('Iliyas');
        $list->add('Akbergen');

        self::assertSame(['Akbergen', 'Iliyas'], $list->toArray());

        $stringsList2 = SortedLinkedListFactory::createForStrings()
            ->add('Iliyas')
            ->add('Akbergen')
            ->add('John')
            ->add('Doe')
            ->remove('John');
        self::assertSame(['Akbergen', 'Doe', 'Iliyas'], $stringsList2->toArray());
    }

    #[Test]
    public function it_can_hold_int_values(): void
    {
        $list = SortedLinkedListFactory::createForInts();
        $list->add(5);
        $list->add(2);

        self::assertSame([2, 5], $list->toArray());

        $intList2 = SortedLinkedListFactory::createForInts(7)
            ->add(10)
            ->add(1)
            ->add(5)
            ->remove(10);
        self::assertSame([1, 5, 7], $intList2->toArray());
    }

    #[Test]
    public function string_list_cannot_hold_int_values(): void
    {
        self::expectException(\InvalidArgumentException::class);

        $list = SortedLinkedListFactory::createForStrings();
        $list->add(5);
    }

    #[Test]
    public function int_list_cannot_hold_int_values(): void
    {
        self::expectException(\InvalidArgumentException::class);

        $list = SortedLinkedListFactory::createForInts();
        $list->add('Iliyas');
    }

    #[Test]
    public function it_can_be_initialized_with_values(): void
    {
        $list = SortedLinkedListFactory::createForInts(5, 2, 8, 1);

        self::assertSame([1, 2, 5, 8], $list->toArray());

        $listString = SortedLinkedListFactory::createForStrings('Zhanakhmetuly', 'Iliyas', 'Akbergen');

        self::assertSame(['Akbergen', 'Iliyas', 'Zhanakhmetuly'], $listString->toArray());
    }

    #[Test]
    public function it_can_hold_duplicate_values(): void
    {
        $list = SortedLinkedListFactory::createForInts();
        $list->add(5);
        $list->add(2);
        $list->add(5);

        self::assertSame([2, 5, 5], $list->toArray());
    }

    #[Test]
    public function it_can_remove_values(): void
    {
        $list = SortedLinkedListFactory::createForInts();
        $list->add(5);
        $list->add(2);
        self::assertSame(2, $list->size());
        $list->remove(5);

        self::assertSame([2], $list->toArray());
        self::assertSame(1, $list->size());
    }

    #[Test]
    public function it_keeps_values_sorted(): void
    {
        $list = SortedLinkedListFactory::createForInts();
        $list->add(10);
        $list->add(1);
        $list->add(5);
        $list->remove(10);
        $list->add(3);

        self::assertSame([1, 3, 5], $list->toArray());

        $listStrings = SortedLinkedListFactory::createForStrings();
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
        $list = SortedLinkedListFactory::createForInts();
        $list->add(5);
        $list->add(2);

        self::assertTrue($list->contains(5));
        self::assertFalse($list->contains(10));

        $listStrings = SortedLinkedListFactory::createForStrings();
        $listStrings->add('Iliyas');
        $listStrings->add('Akbergen');
        self::assertTrue($listStrings->contains('Akbergen'));
        self::assertFalse($listStrings->contains('test'));
    }

    #[Test]
    public function it_can_get_size_of_list(): void
    {
        $list = SortedLinkedListFactory::createForInts();
        self::assertSame(0, $list->size());

        $list->add(5);
        $list->add(2);
        self::assertSame(2, $list->size());

        $list->remove(5);
        self::assertSame(1, $list->size());

        $listWithInitialValues = SortedLinkedListFactory::createForInts(1, 2, 3);
        self::assertSame(3, $listWithInitialValues->size());
    }

    #[Test]
    public function removing_non_existent_value_does_nothing(): void
    {
        $list = SortedLinkedListFactory::createForInts();
        $list->add(5);
        $list->add(2);
        $list->remove(10);

        self::assertSame([2, 5], $list->toArray());
    }

    #[Test]
    public function it_removes_all_matches_values(): void
    {
        $list = SortedLinkedListFactory::createForInts();
        $list->add(5);
        $list->add(2);
        $list->add(5);
        $list->add(3);
        $list->remove(5);

        self::assertSame([2, 3], $list->toArray());
        self::assertSame(2, $list->size());
    }
}
