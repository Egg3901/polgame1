<?php
$id = $_GET['id'];
include 'navigation.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

if (is_null($id)) {
    $con = OpenCon(); // opens a connection to the database, this function is from the above included script
    $stmt = $con->prepare('SELECT email, influence, polstate, polname, imgurl, social, economic, action, funding, party FROM accounts WHERE id = ?');
    $stmt->bind_param('i', $id); // gets the id var from the current session, binds it to the
    $stmt->execute();
    $stmt->bind_result( $influence, $polstate, $polname, $imgurl, $social, $economic, $ap, $funds, $partyid);
    $stmt->fetch();
    $stmt->close();
    $con = OpenCon(); // opens a connection to the database, this function is from the above included script
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
    $stmt->bind_result( $influence, $polstate, $polname, $imgurl, $social, $economic, $ap, $funds, $partyid);
    $stmt->fetch();
    $stmt->close();
    $con = OpenCon(); // opens a connection to the database, this function is from the above included script
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
                <td><a href="state.php?state=<?=$polstate?>"><?=$polstate?></a></td>
            </tr>
            <tr>
                <td>Social Position:</td>
                <td>
                    <?php
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
                    if ($social <= -5){
                        $formattedsocial = "Libertarian Left";
                    }
                    echo $formattedsocial;
                    ?>


                </td>
            </tr>  <!--- social position formatting ---->
            <tr>
                <td>Economic Position:</td>
                <td>

                    <?php

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


                    echo "$formattedeconomic";
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
