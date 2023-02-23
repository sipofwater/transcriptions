<?php

namespace Sipofwater\LaracastsPackagingTest;

class Transcription {

//    protected array $lines;

    /**
     * @param array $lines
     */
    public function __construct(array $lines)
    {
        $this->lines = $lines;
    }

    public static function load(string $path): self {
        //$instance = new static();
        //////$instance->lines = $instance->discardInvalidLines(file($path));
        //$instance->lines = $instance->discardInvalidLines(array_map('trim', file($path)));
        //return $instance;

        return new static($path);
    }

    public function lines(): array {
        // $lines = $this->lines;

        $lines = [];

        for($i = 0; $i < count($this->lines); $i += 2) {
            $lines[] = new Line($this->lines[$i], $this->lines[$i + 1]);
        }

        return $lines;
    }

    protected function discardInvalidLines(array $lines): array {

        //$lines = array_map('trim', $lines);

        return array_values(array_filter($lines, function ($line) {

            $line = trim($line);

            //return $line !== 'WEBVTT' && $line !== '' && !is_numeric($line);
            return Line::valid($line);
        }));
    }

    public function __toString(): string {
        return implode("\n", $this->lines);
    }

}