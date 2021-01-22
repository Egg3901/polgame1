<?php
include 'adminscripts/connect.php';
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
$con = OpenCon(); // opens a connection to the database, this function is from the above included script
$stmt = $con->prepare('SELECT polstate, polname FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($polstate, $polname);
$stmt->fetch();
$stmt->close();

?>
<head>
    <meta charset="utf-8">
    <title>AHD - <?=$polname?></title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">
<nav class="navtop">
    <div>
        <h1>A House Divided (WIP)</h1>
        <a href="profile.php"><i class="fas fa-user-circle"></i><?php echo $polname ?></a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        <a href="state.php?state=<?=$polstate?>"><i class="fas fa-flag-usa"></i><?=$polstate?></a>
    </div>
</nav>
