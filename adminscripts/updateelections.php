<?php
include 'connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 'on');
$con = OpenCon();
$uquery = 'FROM states SELECT govelectionvotes, govtime, population';
$stmt = $con->prepare($uquery);
$stmt->execute();
$stmt->fetch();
$stmt->close();
$result = $stmt->get_result();
foreach ($result as $row) {
    $population = $row['population'];
    $governor_time_remaining = $row['govtime'];
    $votes_added = $population / $governor_time_remaining;
    $newtime = $governor_time_remaining - 1;


}



