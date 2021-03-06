<?php
include 'connect.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$con = OpenCon();
$det = $con->prepare('SELECT action, influence FROM accounts WHERE id = ?');
$det->bind_param('i', $_SESSION['id']); // gets the id var from the current session, binds it to the
$det->execute();
$det->bind_result($action, $influence);
$det->fetch();
$det->close();
if ( $influence < 98){
    if ($action < 5) {
        header('Location: ../profile.php');
    }
    if ($action >= 5){
        $uquery = 'UPDATE accounts SET recognitionbase = recognitionbase + 0.5 WHERE id = ?';
        $stmt = $con->prepare($uquery);
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
        $uquery = 'UPDATE accounts SET influence = influence + 1 + (recognitionbase * .1) WHERE id = ?';
        $stmt = $con->prepare($uquery);
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
        $action = round($action - 5);
        $uquery = 'UPDATE accounts SET action = ? WHERE id = ? ';
        $stmt = $con->prepare($uquery);
        $stmt->bind_param('ii', $action,$_SESSION['id']);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
        header('Location: ../campaignoffice.php');

    }
}
else {
    header('Location: ../profile.php');
}

