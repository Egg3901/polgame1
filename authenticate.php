<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
include 'connect.php';
$con = OpenCon();

if ( !isset($_POST['username'], $_POST['password']) ) {
    exit('Please fill both the username and password fields!');
}
if ($stmt = $con->prepare('SELECT id, password, polname FROM accounts WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $polname);
        $stmt->fetch();

        if (password_verify($_POST['password'], $password)) {

            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['polname'] = $_POST['polname']; //assigns the user's polname for this session
            $_SESSION['name'] = $_POST['username']; //assigns the user's polname for this session
            $_SESSION['id'] = $id; //assigns the user's id for this session
            header('Location: profile.php'); //redirects to profile after login and session initialization

        } else {
            // Incorrect password
            echo 'Incorrect username and/or password!';
        }
    } else {
        // Incorrect username
        echo 'Incorrect username and/or password!';
    }

    $stmt->close();

}
CloseCon($conn);



