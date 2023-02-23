<?php

use Sipofwater\LaracastsPackagingTest\Transcription;

require 'vendor/autoload.php';

$path = __DIR__ . '/../tests/stubs/basic-example.vtt';

// $file = __DIR__ . '/stubs/basic-example.vtt';

$lines = Transcription::load($path)->lines();

//var_dump((string)Transcription::load($path));
//var_dump(Transcription::load($path)->lines());

foreach($lines as $line) {
    var_dump($line->beginningTimestamp() . ' - ' . $line->body);
}
