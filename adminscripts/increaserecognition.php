<?php
include 'connect.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$con = OpenCon();
$uquery = 'UPDATE accounts SET influencebase = influencebase + 0.5 WHERE polname = ?';
$stmt = $con->prepare($uquery);
$stmt->bind_param('s', $_SESSION['polname']);
$stmt->execute();
$stmt->fetch();
$stmt->close();
$con = OpenCon();
$uquery = 'UPDATE accounts SET influence = influence + 1 + (influencebase * .1) WHERE polname = ?';
$stmt = $con->prepare($uquery);
$stmt->bind_param('s', $_SESSION['polname']);
$stmt->execute();
$stmt->fetch();
$stmt->close();