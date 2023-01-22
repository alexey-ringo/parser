<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', -1);

set_time_limit(0);

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/functions.php';

if (isset($argv[1])) {
    $client = new \GuzzleHttp\Client();
    $document = new \DiDom\Document();
    $url = $argv[1];

    echo "Start parsing ...\n";

    $file = getHtml($url, $client);

    $document->loadHtml($file);

    $pagesCount = getPagesCount($document);

    for ($i = 1; $i <= $pagesCount; $i++ ) {
        echo "PAGE PARSING {$i} of {$pagesCount}...\n";
        sleep(rand(1,3));

        if ($i > 1) {
            $file = getHtml($url . "?page={$i}", $client);
            $document->loadHtml($file);
        }

        getProducts($document, $client);
    }
}
