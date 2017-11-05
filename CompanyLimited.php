#!/usr/bin/php
<?php
$path = dirname(__FILE__);
require_once $path . '/InputOutput.php';

class CompanyLimited{

    public function __construct(){
        $inputOutput = new InputOutput();
        $year = $inputOutput->getUserInput();
        $inputOutput->exportToFile($year);
    }
}
// Run test
(new CompanyLimited());


