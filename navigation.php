<?php
include 'adminscripts/connect.php';

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
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
</head>
<body class="mainbody">
<nav class="navtop">
    <div class="container">
        <h1 id="main-title-header" class="main-title-header">A House Divided</h1>
        <a href="profile.php"><i class="fas fa-user-circle"></i><?php echo $polname ?></a>
        <a href="campaignoffice.php"><i class="fas fa-briefcase"></i> Campaign Office</a>
        <a href="state.php?state=<?=$polstate?>"><i class="fas fa-flag-usa"></i><?=$polstate?></a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</nav>
