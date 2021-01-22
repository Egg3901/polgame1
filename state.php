

<?php
include 'navigation.php';

error_reporting(E_ALL);
ini_set('display_errors', 'on');
$state = $_GET['state'];
$imgsource = "img/states/{$state}";

echo "

<br>
<div>
    <h1 style='text-align: center; font-size: 40px;'>The State of   " . $state . "   </h1>
    <br>
    <img style='width: 30%; height: auto; border: 2px solid black;' src=$imgsource alt='state image'>
</div>"
;

echo "
    
    <br>
    <div class='center'>
    <table border='1'>
        <th>Influence</th>
        <th> Politician Name</th>
        <th>Social Position</th>
        <th> Economic Position</th>
    
";


$uquery = 'SELECT influence, polname, social, economic FROM accounts WHERE polstate = ?';
$stmt = $con->prepare($uquery);
$stmt->bind_param("s", $state);
$stmt->execute();
$result = $stmt->get_result();
foreach ($result as $row) {
    print " <tr> ";
    foreach ($row as $polname=>$data){
        print " <td> $data</td> ";
    }
    print " </tr> ";
}
print "</table>";
print "</div>";
?>
