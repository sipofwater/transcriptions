<?php

namespace Sipofwater\LaracastsPackagingTest;

class Transcription {

    public function __construct(protected array $lines) {
        $this->lines = $this->discardInvalidLines(array_map('trim', $lines));
    }

    public static function load(string $path): self {

        $lines = file($path);

        return new static($lines);
    }

    public function lines(): array {

        $lines = [];

        for($i = 0; $i < count($this->lines); $i += 2) {
            $lines[] = new Line($this->lines[$i], $this->lines[$i + 1]);
        }

        return $lines;
    }

    public function htmlLines() {
        $htmlLines = array_map(function (Line $line) {
            return $line->toAnchorTag();
        }, $this->lines());

        return implode("\n", $htmlLines);
    }

    protected function discardInvalidLines(array $lines): array {

        return array_values(array_filter($lines, function ($line) {
            return Line::valid($line);
        }));
    }

    public function __toString(): string {
        return implode("\n", $this->lines);
    }

}