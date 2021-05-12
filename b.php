<?php

declare(strict_types=1);

use Yasumi\Holiday;
use Yasumi\Yasumi;

require 'vendor/autoload.php';
/**
 * Object hashing tests.
 */
$sos = new SplObjectStorage();

$docs = [];
$iterations = 9999;

for ($i = 1000; $i <= $iterations; ++$i) {
    //$doc = new DOMDocument();
//    $doc = new Holiday(
//        'test' . $i,
//        ['en' => 'Test', $i],
//        new DateTimeImmutable());
//    //$doc = new stdClass();

    $doc = Yasumi::create('Australia', $i);

    $docs[] = $doc;
}

$start = $finis = 0;

$mem_empty = memory_get_usage();

// Load the SplObjectStorage
$start = microtime(true);
foreach ($docs as $d) {
    $sos->attach($d);
}
$finis = microtime(true);

$time_to_fill = $finis - $start;

echo $sos->count();
echo $sos->getInfo();

// Check membership on the object storage
$start = microtime(true);
foreach ($docs as $d) {
    $sos->contains($d);
}

$finis = microtime(true);

$time_to_check = $finis - $start;

$mem_spl = memory_get_usage();

$mem_used = $mem_spl - $mem_empty;

printf("SplObjectStorage:\nTime to fill: %0.12f.\nTime to check: %0.12f.\nMemory: %d\n\n", $time_to_fill, $time_to_check, $mem_used);

unset($sos);
$mem_empty = memory_get_usage();

// Test arrays:
$start = microtime(true);
$arr = [];

// Load the array
foreach ($docs as $d) {
    $arr[spl_object_hash($d)] = $d;
}
$finis = microtime(true);

$time_to_fill = $finis - $start;

// Check membership on the array
$start = microtime(true);
foreach ($docs as $d) {
    //$arr[spl_object_hash($d)];
    isset($arr[spl_object_hash($d)]);
}

$finis = microtime(true);

$time_to_check = $finis - $start;
$mem_arr = memory_get_usage();

$mem_used = $mem_arr - $mem_empty;

printf("Arrays:\nTime to fill: %0.12f.\nTime to check: %0.12f.\nMemory: %d\n\n", $time_to_fill, $time_to_check, $mem_used);
