<?php

namespace Sipofwater\LaracastsPackagingTest;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

class Lines implements Countable, IteratorAggregate, ArrayAccess {

    public function __construct(protected array $lines)
    {
        //
    }

    public function asHtml() {
        $formattedLines = array_map(
            fn(Line $line) => $line->toAnchorTag(),
            $this->lines
        );

        return (new static($formattedLines))->__toString();
    }

    public function count(): int {
        return count($this->lines);
    }

    public function __toString(): string {
        return implode("\n", $this->lines);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->lines);
    }

    public function offsetExists(mixed $key): bool
    {
        return isset($this->lines[$key]);
    }

    public function offsetGet(mixed $key): mixed
    {
        return $this->lines[$key];
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        if (is_null($key)) {
            $this->lines[] = $value;
        } else {
            $this->lines[$key] = $value;
        }
    }

    public function offsetUnset(mixed $key): void
    {
        unset($this->lines[$key]);   
    }
}