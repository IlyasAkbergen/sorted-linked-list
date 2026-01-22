# Sorted Linked List Library

### Test task progress logs  
[Progress Logs](./PROGRESS_LOG.md)

### Overview
This project is a PHP library that implements a sorted linked list data structure. The library allows users to create a linked list where elements are automatically sorted upon insertion. It provides methods for adding, removing, and searching for elements in the list.
### Features
- Automatic sorting of elements upon insertion
- Methods for adding, removing, and searching elements
- Unit tests to ensure functionality and reliability

### Installation
Add in your `composer.json`:

```json
{
    "repositories": [
      {
        "type": "vcs",
        "url": "https://github.com/IlyasAkbergen/sorted-linked-list"
      }
    ]
}
```

Then run:

```shell
composer install
```

### Unit Tests
```shell
vendor/bin/phpunit tests
```

### Usage

```php
   use Ilyasakbergen\SortedLinkedList\SortedLinkedListFactory;

   $list = SortedLinkedListFactory::createForInts();
   $list->add(5)
     ->add(2)
     ->add(10)
     ->add(8)
     ->remove(10);
   
   // The list is now sorted: 2 -> 5 -> 8

   $stringsList = SortedLinkedListFactory::createForStrings();
   $stringsList->add('Iliyas')
     ->add('Akbergen')
     ->add('John')
     ->add('Doe')
     ->remove('John');

   // The list is now sorted: Akbergen -> Doe -> Iliyas
   ```

### Demo
A demo script is available at `demo/demo.php`. You can run it using the command:

```shell
cd demo &&
  composer install &&
  php demo.php
```
