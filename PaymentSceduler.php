<?php

class PaymentSceduler{

    private $fileOutputFields = array('months' => array('01-31' => 'January', '02-28' => 'Febuary', '03-31' => 'March',
                                                          '04-30' => 'April', '05-31' => 'May', '06-30' => 'June',
                                                          '07-31' => 'July', '08-31' => 'August', '09-30' => 'September',
                                                          '10-31' => 'October','11-30' => 'November','12-31' => 'December'),
                                        'header' => "Month Name, 1st expenses day, 2nd expenses day, Salary day",
                                        'expenses' => array('1', '15')
                                       );
    private $salaryDates = array();
    private $firstExpensesDates= array();
    private $secondExpensesDates = array();
    

    /********************************************************************************
    Only method implemented by child - This method takes a year parameter and returns
    the expenses and salary dates in a format to be output to the file.
    ********************************************************************************/  
    public function getPaymentDatesFormatted($year){

          $this->getSalaryDates($year);
          $this->get1stExpensesDates($year);
          $this->get2ndExpensesDates($year);
          $paymentDatesFormatted =  $this->fileOutputFields['header'] . "\n" . 
                                    $this->fileOutputFields['months']['01-31'] . 
                                    ', ' . $this->firstExpensesDates[$this->fileOutputFields['months']['01-31']] . ', ' . 
                                    $this->secondExpensesDates[$this->fileOutputFields['months']['01-31']] . ', ' . 
                                    $this->salaryDates[$this->fileOutputFields['months']['01-31']] . "\n" . 
                                    $this->fileOutputFields['months']['02-28'] . 
                                    ', ' . $this->firstExpensesDates[$this->fileOutputFields['months']['02-28']] . ', ' . 
                                    $this->secondExpensesDates[$this->fileOutputFields['months']['02-28']] . ', ' . 
                                    $this->salaryDates[$this->fileOutputFields['months']['02-28']] . "\n" .
                                    $this->fileOutputFields['months']['03-31'] . 
                                    ', ' . $this->firstExpensesDates[$this->fileOutputFields['months']['03-31']] . ', ' . 
                                    $this->secondExpensesDates[$this->fileOutputFields['months']['03-31']] . ', ' . 
                                    $this->salaryDates[$this->fileOutputFields['months']['03-31']] . "\n" .
                                    $this->fileOutputFields['months']['04-30'] . 
                                    ', ' . $this->firstExpensesDates[$this->fileOutputFields['months']['04-30']] . ', ' . 
                                    $this->secondExpensesDates[$this->fileOutputFields['months']['04-30']] . ', ' . 
                                    $this->salaryDates[$this->fileOutputFields['months']['04-30']] . "\n" .
                                    $this->fileOutputFields['months']['05-31'] . 
                                    ', ' . $this->firstExpensesDates[$this->fileOutputFields['months']['05-31']] . ', ' . 
                                    $this->secondExpensesDates[$this->fileOutputFields['months']['05-31']] . ', ' . 
                                    $this->salaryDates[$this->fileOutputFields['months']['05-31']] . "\n" .
                                    $this->fileOutputFields['months']['06-30'] . 
                                    ', ' . $this->firstExpensesDates[$this->fileOutputFields['months']['06-30']] . ', ' . 
                                    $this->secondExpensesDates[$this->fileOutputFields['months']['06-30']] . ', ' . 
                                    $this->salaryDates[$this->fileOutputFields['months']['06-30']] . "\n" .
                                    $this->fileOutputFields['months']['07-31'] . 
                                    ', ' . $this->firstExpensesDates[$this->fileOutputFields['months']['07-31']] . ', ' . 
                                    $this->secondExpensesDates[$this->fileOutputFields['months']['07-31']] . ', ' . 
                                    $this->salaryDates[$this->fileOutputFields['months']['07-31']] . "\n" .
                                    $this->fileOutputFields['months']['08-31'] . 
                                    ', ' . $this->firstExpensesDates[$this->fileOutputFields['months']['08-31']] . ', ' . 
                                    $this->secondExpensesDates[$this->fileOutputFields['months']['08-31']] . ', ' . 
                                    $this->salaryDates[$this->fileOutputFields['months']['08-31']] . "\n" .
                                    $this->fileOutputFields['months']['09-30'] . 
                                    ', ' . $this->firstExpensesDates[$this->fileOutputFields['months']['09-30']] . ', ' . 
                                    $this->secondExpensesDates[$this->fileOutputFields['months']['09-30']] . ', ' . 
                                    $this->salaryDates[$this->fileOutputFields['months']['09-30']] . "\n" .
                                    $this->fileOutputFields['months']['10-31'] . 
                                    ', ' . $this->firstExpensesDates[$this->fileOutputFields['months']['10-31']] . ', ' . 
                                    $this->secondExpensesDates[$this->fileOutputFields['months']['10-31']] . ', ' . 
                                    $this->salaryDates[$this->fileOutputFields['months']['10-31']] . "\n" .
                                    $this->fileOutputFields['months']['11-30'] . 
                                    ', ' . $this->firstExpensesDates[$this->fileOutputFields['months']['11-30']] . ', ' . 
                                    $this->secondExpensesDates[$this->fileOutputFields['months']['11-30']] . ', ' . 
                                    $this->salaryDates[$this->fileOutputFields['months']['11-30']] . "\n" .
                                    $this->fileOutputFields['months']['12-31'] . 
                                    ', ' . $this->firstExpensesDates[$this->fileOutputFields['months']['12-31']] . ', ' . 
                                    $this->secondExpensesDates[$this->fileOutputFields['months']['12-31']] . ', ' . 
                                    $this->salaryDates[$this->fileOutputFields['months']['12-31']] . "\n" ;
         //error_log('Payment dates formatted: ' . print_r($paymentDatesFormatted, 1)); 
         return $paymentDatesFormatted;         
    }

    private function getSalaryDates($year){
          foreach($this->fileOutputFields['months'] as $key => $value){
                 $date = $year . '-' . substr($key, 0, 2) . '-' . substr($key, 3, 2);              
                 $leapYear = date('L', strtotime($date)) ? 'Yes' : 'No';
                 //error_log('Leap year: ' . print_r($leapYear, 1));
                 if($value == 'Febuary' && $leapYear == 'Yes'){
                      $dateInMonthFeb = substr($key, 3, 2) + 1;                                              
                      $date = $year . '-' . substr($key, 0, 2) . '-' . $dateInMonthFeb;
                 }
                 $day = date('w', strtotime($date));
                 if($day == 5){                    
                      $dateInMonth = substr($key, 3, 2) - 1;  
                      $this->salaryDates[$value] = $year . '-' . substr($key, 0, 2) . '-' . $dateInMonth;
                 }elseif($day == 6){ 
                      $dateInMonth = substr($key, 3, 2) - 2;
                      $this->salaryDates[$value] = $year . '-' . substr($key, 0, 2) . '-' . $dateInMonth;
                 }else{ 
                      $this->salaryDates[$value] = $date;
                 }
          }      

    }

    private function get1stExpensesDates($year){

          foreach($this->fileOutputFields['months'] as $key => $value){
                 $date = $year . '-' . substr($key, 0, 2) . '-0' . $this->fileOutputFields['expenses'][0];
                 $day = date('w', strtotime($date));
                 if($day == 5){
                      $dateInMonth = '0' . ($this->fileOutputFields['expenses'][0] + 2);
                      $this->firstExpensesDates[$value] = $year . '-' . substr($key, 0, 2) . '-' . $dateInMonth;
                 }elseif($day == 6){
                      $dateInMonth = '0' . ($this->fileOutputFields['expenses'][0] + 1);
                      $this->firstExpensesDates[$value] = $year . '-' . substr($key, 0, 2) . '-' . $dateInMonth;
                 }else{
                      $this->firstExpensesDates[$value] = $date;
                 }
          }         

    }

    private function get2ndExpensesDates($year){

          foreach($this->fileOutputFields['months'] as $key => $value){
                 $date = $year . '-' . substr($key, 0, 2) . '-' . $this->fileOutputFields['expenses'][1];
                 $day = date('w', strtotime($date));
                 if($day == 5){
                      $dateInMonth = $this->fileOutputFields['expenses'][1] + 2;
                      $this->secondExpensesDates[$value] = $year . '-' . substr($key, 0, 2) . '-' . $dateInMonth;
                 }elseif($day == 6){
                      $dateInMonth = $this->fileOutputFields['expenses'][1] + 1;
                      $this->secondExpensesDates[$value] = $year . '-' . substr($key, 0, 2) . '-' . $dateInMonth;
                 }else{
                      $this->secondExpensesDates[$value] = $date;
                 }
          }         

    }

}


