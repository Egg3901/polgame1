

<?php
include 'navigation.php';

error_reporting(E_ALL);
ini_set('display_errors', 'on');
$state = $_GET['state'];
$imgsource = "img/states/{$state}";

echo "<div class ='state-header'>
<h1>The State of  " . $state . " </h1>

<img src=$imgsource alt='state image'>

</tr>";

echo "
    <table border='1'>
        <th>Influence</th>
        <th> Politician Name</th>
        <th>Social Position</th>
        <th> Economic Position</th>
";


$uquery = 'SELECT influence, polname, social, economic FROM accounts WHERE polstate = ?';
$stmt = $conn->prepare($uquery);
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

?>
