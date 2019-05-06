<?php

require_once('vendor/autoload.php');

use Applitools\Images\Eyes;
use Applitools\RectangleSize;
use Applitools\PrintLogHandler;


class HelloWorld
{
    public function demo()
    {

        // Initialize the eyes SDK and set your private API key.
        $eyes = new Eyes();
        $eyes->setApiKey($_ENV["APPLITOOLS_API_KEY"]);
        $eyes->setLogHandler(new PrintLogHandler(true));

        try {

            $appName = 'Hello World!';
            $testName = 'PHP Screenshot test!';

            // Start the test with a viewport size of 800x600.
            $eyes->open($appName, $testName, new RectangleSize(800, 600));

            // Load page image and validate.
            $imgPath = __DIR__ . '/applitools.jpg';

            // Download an image.
            copy('https://applitools.com/tutorials/applitools.jpg', $imgPath);

            // Visual validation.
            $eyes->checkImage($imgPath, "Applitools image");

            // End the test.
            $eyes->close();
        } finally {

            // If the test was aborted before eyes->close was called,
            // ends the test as aborted.
            $eyes->abortIfNotClosed();
        }
    }
}

$test = new HelloWorld();
$test->demo();
