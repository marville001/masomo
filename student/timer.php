<?php

//You must call the function session_start() before
//you attempt to work with sessions in PHP!
session_start();

//Check to see if our countdown session
//variable has been initialized.
if(!isset($_SESSION['countdown'])){
    //Set the countdown to 120 seconds.
    $_SESSION['countdown'] = 120;
    //Store the timestamp of when the countdown began.
    $_SESSION['time_started'] = time();
}

//Get the current timestamp.
$now = time();

//Calculate how many seconds have passed since
//the countdown began.
$timeSince = $now - $_SESSION['time_started'];

//How many seconds are remaining?
$remainingSeconds = abs($_SESSION['countdown'] - $timeSince);

//Print out the countdown.
echo "There are $remainingSeconds seconds remaining.";

//Check if the countdown has finished.
if($remainingSeconds < 1){
   //Finished! Do something.
}
?>