<?php

$stategiven = $_GET['state'];
$thisPage=$stategiven;
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>

<?php
include 'connect.php';
$stmt = $con->prepare('SELECT polstate, polname FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($polstate, $polname);
$stmt->fetch();
$stmt->close();
?>
<head>
    <meta charset="utf-8"
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">
<nav class="navtop"
    <div id="navigation">
        <a href="profile.php"><i class="fas fa-user-circle"></i>
            </i><?php echo $polname ?></a>
        <a href="state.php?state=<?php echo $polstate?>"><i class="fas fa-flag-usa"></i>
            </i><?php echo $polstate ?></a>
    </div>
</body>
