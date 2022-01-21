<?php 
    include_once('../db/dbconnect.php');
    include_once('../functions/functions.php');
    include('../common_script.php');
    include("../database.php");
    echo $currentDate = date('Y-m-d'); // current date //

    file_put_contents('r.txt',$currentDate.PHP_EOL, FILE_APPEND);

 ?>