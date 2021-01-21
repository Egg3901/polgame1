

<?php include 'navigation.php';

$state = $_GET['state'];
include 'connect.php';
$con = OpenCon();

echo "
<div class ='state-header'>
<h1>The State of  $state </h1>
<tr>



</tr>";

echo "
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

CloseCon($conn);
?>
