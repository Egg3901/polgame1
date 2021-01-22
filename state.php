

<?php
include 'navigation.php';

error_reporting(E_ALL);
ini_set('display_errors', 'on');
$statef =urlencode( $_GET['state']);
$state = str_replace('+', ' ', $statef);
$imgsource = "img/states/{$statef}";

echo "
<div>
<br>
<div>
    <h1 style='text-align: center; font-size: 40px;'>The State of   " . $state . "   </h1>
    <br>
    <img style='width: 30%; height: auto; border: 2px solid black; display: block; margin: auto;' src=$imgsource alt='state image'>
</div>"
;

echo "
    
    <br>
    <div class='center'>
    <table border='.5' style='margin:auto;'>
        <th>Influence</th>
        <th> Politician Name</th>
        <th>Social Position</th>
        <th> Economic Position</th>
    
";


$uquery = 'SELECT influence, polname, social, economic FROM accounts WHERE polstate = ? ORDER BY influence';
$stmt = $con->prepare($uquery);
$stmt->bind_param("s", $state);
$stmt->execute();
$result = $stmt->get_result();

foreach ($result as $row) {
    print " <tr> ";
    $iter = 0;
    foreach ($row as $polname=>$data){
        if ($iter = 0) {  //influence
            print " <td> $data % </Td>";
        }
        if ($iter = 1) {  //name
            print " <td> $data </td> ";
        }
        if ($iter = 2) { // social position data on state page
            $social = $data;
            if ($social <= 5){
                $formattedsocial = "Very Right Wing";
            }
            if ($social <= 4){
                $formattedsocial = "Right Wing";
            }
            if ($social <= 3){
                $formattedsocial = "Leans Right Wing";
            }
            if ($social <= 1){
                $formattedsocial = "Center Right";
            }
            if ($social <= 0){
                $formattedsocial = "Centrist";
            }
            if ($social <= -1){
                $formattedsocial = "Center Left";
            }
            if ($social <= -3){
                $formattedsocial = "Leans Left Wing";
            }
            if ($social <= -4){
                $formattedsocial = "Left Wing";
            }
            if ($social <= -5) {
                $formattedsocial = "Libertarian Left";
            }
            print " <td> $formattedsocial </td> ";
        }
        if ($iter = 3){
            $economic = $data;
            if ($economic <= 5){
                $formattedeconomic = "Libertarian Right";
            }
            if ($economic <= 4){
                $formattedeconomic = "Right Wing";
            }
            if ($economic <= 3){
                $formattedeconomic = "Leans Right Wing";
            }
            if ($economic <= 1){
                $formattedeconomic = "Center Right";
            }
            if ($economic <= 0){
                $formattedeconomic = "Centrist";
            }
            if ($economic <= -1){
                $formattedeconomic = "Center Left";
            }
            if ($economic <= -3){
                $formattedeconomic = "Leans Left Wing";
            }
            if ($economic <= -4){
                $formattedeconomic = "Left Wing";
            }
            if ($economic <= -5){
                $formattedeconomic = "Very Left Wing";
            }
            print " <td> $formattedsocial </td> ";

        }
        $iter = $iter +1;
    }
    print " </tr> ";
}
print "</table>";
print "</div>";
print "</div>";
?>
