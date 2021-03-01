<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
function OpenCon(): mysqli {
    $dbhost = "localhost";
    $dbuser = "ahousedi_admin";
    $dbpass = "admindc1511rma";
    $db = "ahousedi_phplogin";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
}
function CloseCon($conn){
    $conn -> close();
}

?>

