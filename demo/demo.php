<?php

require_once __DIR__ . '/vendor/autoload.php';

use Ilyasakbergen\SortedLinkedList\SortedLinkedListFactory;

echo "Testing Sorted Linked List Library\n";
echo "===================================\n\n";

// Test with integers
echo "Test Integer List\n";
echo "--------------------\n";
$list = SortedLinkedListFactory::createForInts();
$list->add(5)
     ->add(2)
     ->add(10)
     ->add(8)
     ->remove(10);

echo "Added: 5, 2, 10, 8\n";
echo "Removed: 10\n";
echo "Expected sorted list: 2 -> 5 -> 8\n";
echo "Actual list: " . implode(' -> ', $list->toArray()) . "\n";
echo "List size: " . $list->size() . "\n";
echo "Contains 5: " . ($list->contains(5) ? 'Yes' : 'No') . "\n";
echo "Contains 10: " . ($list->contains(10) ? 'Yes' : 'No') . "\n\n";

// Test with strings
echo "Test String List\n";
echo "-------------------\n";
$stringsList = SortedLinkedListFactory::createForStrings();
$stringsList->add('Iliyas')
            ->add('Akbergen')
            ->add('John')
            ->add('Doe')
            ->remove('John');

echo "Added: Iliyas, Akbergen, John, Doe\n";
echo "Removed: John\n";
echo "Expected sorted list: Akbergen -> Doe -> Iliyas\n";
echo "Actual list: " . implode(' -> ', $stringsList->toArray()) . "\n";
echo "List size: " . $stringsList->size() . "\n";
echo "Contains 'Doe': " . ($stringsList->contains('Doe') ? 'Yes' : 'No') . "\n";
echo "Contains 'John': " . ($stringsList->contains('John') ? 'Yes' : 'No') . "\n\n";

echo "Tests completed successfully!\n";
