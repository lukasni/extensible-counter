<?php 

require_once 'bootstrap.php';

$cdriver = new Counter_File(_APPATH_.'example.xml');
$vdriver = new Validation_Dummy();

$counter = new Counter($cdriver, $vdriver, $_SERVER['SCRIPT_NAME']);

$counter->update();

echo $counter->page;
echo ": ";
echo $counter->getCount();