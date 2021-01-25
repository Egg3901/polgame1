<?php
include '../adminscripts/connect.php';


$con = OpenCon();
$det = $con->prepare('SET rrace = 1 FROM accounts WHERE id = ?');
$det->bind_param('i', $_SESSION['id']); // gets the id var from the current session, binds it to the
$det->execute();
$det->fetch();
$det->close();


