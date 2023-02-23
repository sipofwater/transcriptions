<?php

namespace Sipofwater\LaracastsPackagingTest;

class Transcription {

    public function __construct(protected array $lines) {
//        $this->lines = $this->discardInvalidLines(array_map('trim', $lines));
        $this->lines = $this->discardInvalidLines($lines);
    }

    public static function load(string $path): self {

        $lines = file($path);

        return new static($lines);
    }

    public function lines(): Lines {

        return new Lines(array_map(function($line) {
            return new Line(...$line);
        }, array_chunk($this->lines, 3)));
    }

    

    protected function discardInvalidLines(array $lines): array {
        return array_slice(array_filter(array_map('trim', $lines)), 1);
    }

    public function __toString(): string {
        return implode("\n", $this->lines);
    }
}