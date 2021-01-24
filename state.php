

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
$con = OpenCon();
$uquery = 'SELECT governor, jsen, ssen FROM states WHERE name = ?';
$stmt = $con->prepare($uquery);
$stmt->bind_param("s", $statef);
$stmt->execute();
$stmt->bind_result($gov,$jsen,$ssen);
$stmt->fetch();
$stmt->close();
echo "
    
    <br>
    <div style='margin: auto;'>
    <table style='margin:auto;'>
        <tr>
            <td>
                <table>
                        <tr> <td style='text-align: center;'>Governor</td></tr>
                        <tr> <td style='text-align: center;'>Governor " . $gov . "</td> </tr>
                </table>
            </td>
            <td>
                <table>
                        <tr> <td style='text-align: center;'>Junior Senator</td></tr>
                        <tr> <td style='text-align: center;'>None</td> </tr>
                </table>
            </td>
            <td>
                <table>
                        <tr> <td style='text-align: center;'>Senior Senator</td></tr>
                        <tr> <td style='text-align: center;'>None</td> </tr>
                </table>
            </td>
        </tr>
    </table>
<table style='margin: auto;'>
<tr>
<td>
    <table border='.5' style='margin:auto;'>
        <th>Name Recognition</th>
        <th>Politician Name</th>
        <th>Social Position</th>
        <th>Economic Position</th>
    
";

$con = OpenCon();
$uquery = 'SELECT influence, polname, social, economic FROM accounts WHERE polstate = ? ORDER BY influence DESC';
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
            $iter = $iter +1;
        }
        else if ($iter = 1) {  //name
            print " <td> $data </td> ";
            $iter = $iter +1;
        }
        else if ($iter = 2) { // social position data on state page
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
            $iter = $iter +1;
        }
        else if ($iter = 3){
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
            $iter = $iter +1;

        }

    }
    print " </tr> ";
}
print "</table>";
echo "
</td>
<td>
     <table border='.5' style='margin: auto; width: 9%;'>
         <tr>
            <th style='width: 9%'>Gubernatorial Election</th>
         </tr>
         <br>
         <form  action='adminscripts/joingovrace.php'>
                <button type='submit' value='Join Race'> Join Gubernatorial Race</button>
         </form>
         <tr>
            <table border='.5' style='margin: auto; width: 9%;'>
                <tr>
                    <td style='width: 9%'> Candidates</td>
                </tr>
                "
                $con = OpenCon();
                $uquery = 'SELECT id FROM statex WHERE polstate = ? ORDER BY influence DESC';
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
                            </table>
                        </tr>
                    </table>
                </td>
                ";
print "</table>";
print "</div>";
print "</div>";
?>
