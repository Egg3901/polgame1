

<?php
include 'common_functions/navigation.php';
include 'common_functions/formatting_functions.php';

error_reporting(E_ALL);
ini_set('display_errors', 'on');
$statef =urlencode( $_GET['state']);
$state = str_replace('+', ' ', $statef);
$imgsource = "img/states/{$statef}";
$con = OpenCon();
$state_info_query = 'SELECT governor, jsen, ssen, population, regionalflair, govtime FROM states WHERE name = ?';
$stmt = $con->prepare($state_info_query);
$stmt->bind_param("s", $state);
$stmt->execute();
$stmt->bind_result($gov,$jsen,$ssen, $pop, $regionalflair, $govtime);
$stmt->fetch();
$stmt->close();
$background_url = 'https://wallpaperaccess.com/full/445331.jpg';
echo "
<div class='main-container'>
    <div class='State-Flag' style='background-image: url(" . $background_url . "); background-size: cover;'>
        <h1 class='main-title-header' style='text-align: center; font-size: 40px;'>The " . $regionalflair . " of   " . $state . "   </h1>
        <br>
        <img style='width: 30%; height: auto; border: 2px solid black; display: block; margin: auto;' src=$imgsource alt='state image'>
        <br><br>
    </div>
";

echo "

    <table class='info-table' style='width: 30%'>
            <th> Governor </th>
            <th> Junior Senator </th>
            <th> Senior Senator </th>
            <tr>
                <td style='text-align: center;'>Governor " . $gov . "</td>
                <td style='text-align: center;'> Junior Senator " . $gov . "</td><
                <td style='text-align: center;'> Senior Senator " . $gov . "</td></tr>                          
            </td>
                    
                   
    </table>
            
        
            
  
    <table class='info-table' style='width: 40%'>
        <th>Name Recognition</th>
        <th>Politician Name</th>
        <th>Social Position</th>
        <th>Economic Position</th>
    
";
// get the state page data
$con = OpenCon();
$uquery = 'SELECT influence, polname, social, economic, id, party FROM accounts WHERE polstate = ? ORDER BY influence DESC';
$stmt = $con->prepare($uquery);
$stmt->bind_param("s", $state);
$stmt->execute();
$result = $stmt->get_result();
foreach ($result as $row) {
    $player_data = $row;
    print " <tr> ";
    $i = round($player_data['influence'],2);
    $n = $player_data['polname'];
    $pid = $player_data['id'];
    echo " 
    <td> $i% </td> 
    <td> <a href='profile.php?id=$pid'>$n </td>    

        ";
    $social= $player_data['social'];
    /// formats economic position for each player in state

    $position_data = formatPosition($position=$social);
    echo "
    <td style='color: $position_data[1]'>" . $position_data[0] . "</td>
    ";
    /// formats social position for each player in state
    $economic = $player_data['economic'];
    $position_data = formatPosition($position=$economic);
    echo "
    <td style='color: $position_data[1]'>" . $position_data[0] . "</td>
    </tr>";
}
echo "
</table>
<br>
<div class='state-race' id='gov'>
     <div>
        <h1 style='text-align: center;'> Gubernatorial Election</h1>
        
        <table class='infotable' style='text-align; auto;'>
            
                <h1 style='text-align: center;'>Candidates</h1>
                <p style='text-align: center;'> Election in " .  $govtime . " hours </p>
            <table border='.5'  class='race' style='margin:auto; width: 40%;'>
                    <th>Politician Name</th>
                    <th>Name Recognition</th>
";
    $con = OpenCon();
    $uquery = 'SELECT polname, influence FROM accounts WHERE polstate = ? AND rrace = 1 ORDER BY influence DESC';
    $stmt = $con->prepare($uquery);
    $stmt->bind_param("s", $state);
    $stmt->execute();
    $result = $stmt->get_result();

    foreach ($result as $row) {
        print " <tr> ";
        $polname = $row['polname'];
        $recognition = round($row['influence'],2);
        echo "
                        <td> " . $polname . " </td>
                        <td> " . $recognition .  "% </td>
                    ";
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
    ";
    echo "
<div class='state-race' id='senate'>
     <div>
        <h1 style='text-align: center;'> Junior Senator Election</h1>
        
        <table class='race' style='text-align; auto;'>
            
                <h1 style='text-align: center;'>Candidates</h1>
            
            <table border='.5'  class='race' style='margin:auto; width: 40%;'>
                    <th>Politician Name</th>
                    <th>Name Recognition</th>";


            $con = OpenCon();
            $uquery = 'SELECT polname, influence FROM accounts WHERE polstate = ? AND rrace = 2  ORDER BY influence DESC';
            $stmt = $con->prepare($uquery);
            $stmt->bind_param("s", $state);
            $stmt->execute();
            $result = $stmt->get_result();

            foreach ($result as $row) {
                print " <tr> ";
                $polname = $row['polname'];
                $recognition = round($row['influence'],2);
                echo "
                    <td> " . $polname . " </td>
                    <td> " . $recognition . "% </td>
                ";
                print " </tr>";
            }
            echo "
            
        </table>
        <div style='text-align: center;'>
                <form  action='adminscripts/joinjsenrace.php' class='race' style='margin: auto; width: 40%'>
                        <button type='submit' value='Join Race' style='margin: auto; width: 100%'> Join Junior Senate Race</button>
                </form>
        </div>
</div>
<div class='state-race' id='senate'>
     <div>
        <h1 style='text-align: center;'> Senior Senator Election</h1>
        
        <table class='race' style='text-align; auto;'>
            
                <h1 style='text-align: center;'>Candidates</h1>
            
            <table border='.5'  class='race' style='margin:auto; width: 40%;'>
                    <th>Politician Name</th>
                    <th>Name Recognition</th>";



$con = OpenCon();
$uquery = 'SELECT polname, influence FROM accounts WHERE polstate = ? AND rrace = 3 ORDER BY influence DESC';
$stmt = $con->prepare($uquery);
$stmt->bind_param("s", $state);
$stmt->execute();
$result = $stmt->get_result();

foreach ($result as $row) {
    print " <tr> ";
    $polname = $row['polname'];
    $recognition = round($row['influence'],2);
    echo "
                    <td> " . $polname . " </td>
                    <td> " . $recognition . "% </td>
                ";
    print " </tr>";
}
echo "
            
        </table>
        <div style='text-align: center;'>
                <form  action='adminscripts/joinssenrace.php' class='race' style='margin: auto; width: 40%'>
                        <button type='submit' value='Join Race' style='margin: auto; width: 100%'> Join Senior Senate Race</button>
                </form>
        </div>
     </div>
    </div>
</div>
";


                




