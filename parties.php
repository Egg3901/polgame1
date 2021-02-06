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
    <div class='main-container'>
    ";

    $con = OpenCon();
    $uquery = 'SELECT partyname FROM parties';
    $stmt = $con->prepare($uquery);
    $stmt->execute();
    $result = $stmt->get_result();
    foreach ($result as $row) {
        $data = $row;
        echo "
        <div>
            <p>" . $row['partyname'] . "</p>
        </div>
        ";
    }
}

