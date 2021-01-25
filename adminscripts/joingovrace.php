<?php
include '../adminscripts/connect.php';


$con = OpenCon();
$det = $con->prepare('UPDATE accounts SET rrace = 1 WHERE id = ?');
$det->bind_param('i', $_SESSION['id']); // gets the id var from the current session, binds it to the
$det->execute();
$det->fetch();
$det->close();


