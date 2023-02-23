<?php

namespace Sipofwater\LaracastsPackagingTest;

class Transcription {

//    protected string $file;
    protected array $lines;

    public static function load(string $path): self {
        $instance = new static();

//        $instance->file = file_get_contents($path);
//        $instance->lines = file($path);
        $instance->lines = $instance->discardIrrelevantLines(file($path));

        return $instance;
    }

    public function lines(): array {
        //var_dump(explode("\n", $this->lines));
        //return [];
        return $this->lines;
    }

    protected function discardIrrelevantLines(array $lines): array {
        return array_filter($lines, function ($line) {
            return trim($line) !== 'WEBVTT';
        });
    }

    public function __toString(): string {
        // return $this->lines;
        // return implode("\n", $this->lines);
        return implode("\n", $this->lines);
    }

}