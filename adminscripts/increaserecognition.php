<?php
include 'connect.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$con = OpenCon();
$uquery = 'UPDATE accounts SET influence = 1 + influencebase * .1 + influencebase AND SET influencebase = influencebase + 0.5  WHERE polname = ?';
$stmt = $con->prepare($uquery);
$stmt->bind_param('i', $_SESSION['polname']);
$stmt->execute();
$stmt->fetch();
$stmt->close();