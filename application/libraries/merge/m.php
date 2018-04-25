<?php
include('vendor/autoload.php');
require_once ('FPDI/fpdi.php');
require_once('FPDI/fpdf.php');

use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;

$m = new Merger();
$m->addFromFile('a.pdf');
$m->addFromFile('b.pdf');
file_put_contents('foobar.pdf', $m->merge());



// $finder = new Finder();
// $finder->files()->in(__DIR__)->name('*.pdf')->sortByName();

// $m = new Merger();
// $m->addFinder($finder);

// file_put_contents('finder.pdf', $m->merge());
?>