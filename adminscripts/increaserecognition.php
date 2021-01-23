<?php
include 'connect.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$con = OpenCon();
$uquery = 'UPDATE accounts SET recognitionbase = recognitionbase + 0.5 WHERE id = ?';
$stmt = $con->prepare($uquery);
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->fetch();
$uquery = 'UPDATE accounts SET influence = influence + 1 + (recognitionbase * .1) WHERE id = ?';
$stmt = $con->prepare($uquery);
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->fetch();
$stmt->close();