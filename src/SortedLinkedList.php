<?php

declare(strict_types=1);

namespace Ilyasakbergen\SortedLinkedList;

abstract class SortedLinkedList
{
    protected ?Node $head = null;
    private int $count = 0;

    public function add(int|string $value): self
    {
        if (!$this->supportsType($value)) {
            throw new \InvalidArgumentException('Unsupported value type.');
        }

        $newNode = new Node($value);
        $this->count++;

        if ($this->head === null || $this->compare($value, $this->head->value) < 0) {
            $newNode->next = $this->head;
            $this->head = $newNode;

            return $this;
        }

        $current = $this->head;
        while ($current->next !== null && $this->compare($value, $current->next->value) >= 0) {
            $current = $current->next;
        }

        $newNode->next = $current->next;
        $current->next = $newNode;

        return $this;
    }

    public function remove(int|string $value): self
    {
        if (!$this->supportsType($value)) {
            throw new \InvalidArgumentException('Unsupported value type.');
        }

        while ($this->head !== null && $this->compare($value, $this->head->value) === 0) {
            $this->head = $this->head->next;
            $this->count--;
        }

        $current = $this->head;
        while ($current !== null && $current->next !== null) {
            if ($this->compare($value, $current->next->value) === 0) {
                $current->next = $current->next->next;
                $this->count--;
            } else {
                $current = $current->next;
            }
        }

        return $this;
    }

    public function toArray(): array
    {
        $result = [];
        $current = $this->head;

        while ($current !== null) {
            $result[] = $current->value;
            $current = $current->next;
        }

        return $result;
    }

    public function contains(int|string $value): bool
    {
        if (!$this->supportsType($value)) {
            throw new \InvalidArgumentException('Unsupported value type.');
        }

        $current = $this->head;

        while ($current !== null) {
            if ($this->compare($value, $current->value) === 0) {
                return true;
            }
            $current = $current->next;
        }

        return false;
    }

    public function size(): int
    {
        return $this->count;
    }

    abstract protected function supportsType(int|string $value): bool;
    abstract protected function compare(int|string $a, int|string $b): int;
}
