<?php 

session_start();

require_once 'bootstrap.php';

$cdriver = new Counter_File(_APPATH_.'example.xml');
//$vdriver = new Validation_Dummy();
$vdriver = new Validation_Session();

$counter = new Counter($_SERVER['SCRIPT_NAME'], $cdriver, $vdriver);

$counter->update();

echo $counter->page;
echo ": ";
echo $counter->getCount();