<?php
include 'navigation.php';

error_reporting(E_ALL);
ini_set('display_errors', 'on');

if (empty($_GET['party'])) {
    $party = NULL;
}
else {
    $party = $_GET['party'];
}


if (is_null($party)) {
    echo "
    <div class='main-container' id='parties-main-container'>
    ";

    $con = OpenCon();
    $uquery = 'SELECT partyname, partybio, id FROM parties';
    $stmt = $con->prepare($uquery);
    $stmt->execute();
    $result = $stmt->get_result();
    foreach ($result as $row) {
        $data = $row;
        $id = $row['id'];
        $partyurl = "parties.php?party={$id}";
        echo "
        <div>
            <h1 id='party-name'><a href=$partyurl> " . $row['partyname'] . " </h1>
            <p id='party-bio'>" . $row['partybio'] . "</p>
        </div>
        ";
    }
}

