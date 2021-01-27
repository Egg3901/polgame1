

<?php
include 'navigation.php';

error_reporting(E_ALL);
ini_set('display_errors', 'on');
$statef =urlencode( $_GET['state']);
$state = str_replace('+', ' ', $statef);
$imgsource = "img/states/{$statef}";

echo "
<style>
    table {
        margin: auto;
        border: 1px solid black;
        background-color: #EEEEEE;
        width: 100%;
        text-align: left;
        border-collapse: collapse;
        
    }
    td {
    border: 1px solid black;
    }
</style>
    <div class='State-Flag'>
        <h1 style='text-align: center; font-size: 40px;'>The State of   " . $state . "   </h1>
        <br>
        <img style='width: 30%; height: auto; border: 2px solid black; display: block; margin: auto;' src=$imgsource alt='state image'>
"

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
</div>
    <table style='width: 30%'>
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
            
        
            
  
    <table style='width: 40%'>
        <th>Name Recognition</th>
        <th>Politician Name</th>
        <th>Social Position</th>
        <th>Economic Position</th>
    
";
// get the state page data
$con = OpenCon();
$uquery = 'SELECT influence, polname, social, economic, id FROM accounts WHERE polstate = ? ORDER BY influence DESC';
$stmt = $con->prepare($uquery);
$stmt->bind_param("s", $state);
$stmt->execute();
$result = $stmt->get_result();
foreach ($result as $row) {
    $data = $row;
    print " <tr> ";
    $i = round($data['influence'],2);
    $n = $data['polname'];
    $pid = $data['id'];
    echo " 
    <td> $i% </td> 
    <td> <a href='profile.php?id=$pid'>$n </td>    

        ";
    $social = $data['social'];
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
    $economic = $data['economic'];
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


    print " </tr> ";
}
print "</table>

";

echo "

<br>
</div>
<div class='gov'>
     <div>
        <h1 style='text-align: center;'> Gubernatorial Election</h1>
        
        <table class='race' style='text-align; auto;'>
            
                <h1 style='text-align: center;'>Candidates</h1>
            
            <table border='.5'  class='race' style='margin:auto; width: 40%;'>
                    <th class='race'>Politician Name</th>
                    <th class='race'>Name Recognition</th>";


            $con = OpenCon();
            $uquery = 'SELECT polname, influence FROM accounts WHERE polstate = ? AND rrace = 1  ORDER BY influence DESC';
            $stmt = $con->prepare($uquery);
            $stmt->bind_param("s", $state);
            $stmt->execute();
            $result = $stmt->get_result();

            foreach ($result as $row) {
                print " <tr> ";
                $iter = 0;
                foreach ($row as $polname => $data) {
                    print " <td> $data </Td>";
                }
                print " </tr>";
            }
            echo "
            
        </table>
        <div style='text-align: center;'>
                <form  action='adminscripts/joingovrace.php' class='race' style='margin: auto; width: 40%'>
                        <button type='submit' value='Join Race' style='margin: auto; width: 100%'> Join Gubernatorial Race</button>
                </form>
        </div>
     </div>
    </div>
</div>
                
";



