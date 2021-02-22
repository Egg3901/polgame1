<?php
$id = $_GET['id'];
include 'navigation.php';

error_reporting(E_ALL);
ini_set('display_errors', 'on');

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

if (is_null($id)) {
    $con = OpenCon(); // opens a connection to the database, this function is from the above included script
    $stmt = $con->prepare('SELECT email, influence, polstate, polname, imgurl, social, economic, action, funding, party FROM accounts WHERE id = ?');
    $stmt->bind_param('i', $id); // gets the id var from the current session, binds it to the
    $stmt->execute();
    $stmt->bind_result( $email,$influence, $home_state, $polname, $imgurl, $social, $economic, $ap, $funds, $partyid);
    $stmt->fetch();
    $stmt->close();
    $stmt = $con->prepare('SELECT  partyname FROM parties WHERE id = ?');
    $stmt->bind_param('i', $partyid); // gets the id var from the current session, binds it to the
    $stmt->execute();
    $stmt->bind_result( $partyname);
    $stmt->fetch();
    $stmt->close();
}
else {
    $con = OpenCon(); // opens a connection to the database, this function is from the above included script
    $stmt = $con->prepare('SELECT  influence, polstate, polname, imgurl, social, economic, action, funding, party FROM accounts WHERE id = ?');
    $stmt->bind_param('i', $id); // gets the id var from the current session, binds it to the
    $stmt->execute();
    $stmt->bind_result( $influence, $home_state, $polname, $imgurl, $social, $economic, $ap, $funds, $partyid);
    $stmt->fetch();
    $stmt->close();
    $stmt = $con->prepare('SELECT  partyname FROM parties WHERE id = ?');
    $stmt->bind_param('i', $partyid); // gets the id var from the current session, binds it to the
    $stmt->execute();
    $stmt->bind_result( $partyname);
    $stmt->fetch();
    $stmt->close();
}
?>


<div class="main-container" id="profile-main-container">
    <div class="profile-container">
        <h2 id="politician-name"> <?=$polname?> </h2>
        <br>
        <table id="politician-table" class="info-table">
            <img class="profile-image" src="<?=$imgurl?>">
            <br>
            <tr>
                <td>Recognition:</td>
                <td><?=$influence?>%</td>
            </tr>
            <tr>
                <td>Actions:</td>
                <td><?=$ap?> actions remaining</td>
            </tr>
            <tr>
                <td>Funding:</td>
                <td><?=$funds?>$</td>
            </tr>
            <tr>
                <td>Political Party:</td>
                <td><?=$partyname?>$</td>
            </tr>
            <tr>
                <td>Location:</td>
                <td><a href="state.php?state=<?=$home_state?>"><?=$home_state?></a></td>
            </tr>
            <tr>
                <td>Social Position:</td>
                <td>
                    <?php
                    echo"
                    
                    "
                    ?>


                </td>
            </tr>  <!--- social position formatting ---->
            <tr>
                <td>Economic Position:</td>
                <td>
                    <?php
                    include 'commonfunctions/formattingfunctions.php';
                    $position_data = formatPosition($position=$economic);
                    echo "
                    <p style='color: $position_data[1]'>". $position_data[0] . "</p>
                    "
                    ?>
                </td>
            </tr>  <!--- economic position formatting ---->
        </table>

    </div>
</div>
</body>
</html>
<?php
CloseCon($con);
