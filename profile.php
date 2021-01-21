<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
include 'connect.php';
$con = OpenCon(); // opens a connection to the database, this function is from the above included script
$stmt = $con->prepare('SELECT password, email, influence, polstate, polname, imgurl, social, economic FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']); // gets the id var from the current session, binds it to the
$stmt->execute();
$stmt->bind_result($password, $email, $influence, $polstate, $polname, $imgurl, $social, $economic);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>AHD - <?=$polname?></title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">
<nav class="navtop">
    <div>
        <h1>A House Divided (WIP)</h1>
        <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        <a href="state.php?state=<?=$polstate?>"><i class="fas fa-flag-usa"></i><?=$polstate?></a>
    </div>
</nav>
<div class="content">
    <h2><?=$polname?></h2>
    <div>
        <h1></h1>
        <table>
            <img src="<?=$imgurl?>">
            <tr>
                <td>Recognition:</td>
                <td><?=$influence?>%</td>
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
        <table>
            <tr>
                <p><i>Your account details are below (Only Visible to you):<i></i></p>
            </tr>
            <tr>
                <td>Username:</td>
                <td><?=$_SESSION['name']?></td>
            </tr>

            <tr>
                <td>Email:</td>
                <td><?=$email?></td>
            </tr>

        </table>
    </div>
</div>
</body>
</html>
<?php
CloseCon($con);
