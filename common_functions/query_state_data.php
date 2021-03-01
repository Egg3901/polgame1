<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
function fetchStateInfo($): array {
    // this function takes a profile ID, and fetches their information from the db
