<?php
include '../adminscripts/connect.php';


$con = OpenCon();
$det = $con->prepare('UPDATE accounts SET rrace = 1 WHERE id = ?');
$det->bind_param('i', $_SESSION['id']); // gets the id var from the current session, binds it to the
$det->execute();
$det->fetch();
$det->close();
$con = OpenCon();
$det = $con->prepare('SELECT polstate FROM accounts WHERE id = ?');
$det->bind_param('i', $_SESSION['id']); // gets the id var from the current session, binds it to the
$det->execute();
$det->bind_result($state);
$det->fetch();
$det->close();
header("Location: ../state.php?state=$state");


