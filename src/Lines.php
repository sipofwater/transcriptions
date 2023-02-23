<?php

namespace Sipofwater\LaracastsPackagingTest;

class Lines extends Collection {

    public function asHtml() {
        return $this->map(fn(Line $line) => $line->toHtml());
    }

    public function __toString(): string {
        return implode("\n", $this->items);
    }
}