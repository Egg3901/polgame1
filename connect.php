<?php
function OpenCon()
{
$dbhost = "localhost";
$dbuser = "ahousedi_admin";
$dbpass = "admindc1511rma";
$db = "ahousedi_phplogin";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

return $conn;
}

function CloseCon($conn)
{
$conn -> close();
}

?>

