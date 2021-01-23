<?php
include 'connect.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$con = OpenCon();
$uquery = 'UPDATE accounts SET influence = influencebase * .1 + 1 + influencebase AND SET influencebase = influencebase + 0.5';
$stmt = $con->prepare($uquery);
$stmt->execute();
$stmt->fetch();
$stmt->close();