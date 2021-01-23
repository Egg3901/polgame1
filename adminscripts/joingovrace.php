<?php
include '../adminscripts/connect.php';


$con = OpenCon();
$det = $con->prepare('SELECT polstate FROM accounts WHERE id = ?');
$det->bind_param('i', $_SESSION['id']); // gets the id var from the current session, binds it to the
$det->execute();
$det->bind_result($statename);
$det->fetch();
$det->close();

$con = OpenCon();
$det = $con->prepare('INSERT INTO statexpartyrel VALUES (?,?,?,?,?)');
$inc = 0;
$party = 1;
$race = 1;
$det->bind_param('isiii', $_SESSION['id'],$statename,$inc,$party,$race); // gets the id var from the current session, binds it to the
$det->execute();
$det->fetch();
$det->close();
