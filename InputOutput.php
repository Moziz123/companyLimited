#!/usr/bin/php

<?php
$path = dirname(__FILE__);
require_once $path . '/PaymentSceduler.php';

class InputOutput extends PaymentSceduler{
    
    private $error = array();

    public function getUserInput(){
        do{
             if(!empty($this->error)){
                 foreach($this->error as $error){
                    echo $error;
                    echo "\n";
                 }  
             }
             echo "Please enter a year (e.g. 1982) to view scheduled payments dates: ";
             $handle = fopen ("php://stdin","r");
             $year = trim(fgets($handle));
             
             $this->error[] = !isset($year) ? 'You need to enter a date.' : null;
             $this->error[] = strlen($year) != 4 ? 'The year must contain 4 characters.' : null;
             $this->error[] = !is_numeric($year) ? 'Please enter a valid year.' : null;    
        }while(!isset($year) || strlen($year) != 4 || !is_numeric($year));

        return $year; 
    }

    public function exportToFile($year){
            $paymentDatesFormatted = $this->getPaymentDatesFormatted($year);
            try{
                $companyLtdFile = fopen("SalaryAndExpensesDates.txt", "w");            
                fwrite($companyLtdFile, $paymentDatesFormatted);
                fclose($companyLtdFile);
            }catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
    }
}



