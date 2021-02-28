<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
function fetchProfile($profile_id): array {
    // this function takes a profile ID, and fetches their information from the db
    if (is_null($profile_id)) {
        $con = OpenCon(); // opens a connection to the database, this function is from the above included script
        $stmt = $con->prepare('SELECT influence, polstate, polname, imgurl, social, economic, action, funding, party FROM accounts WHERE id = ?');
        $stmt->bind_param('i', $id); // gets the id var from the current session, binds it to the
        $stmt->execute();
        $stmt->bind_result( $influence, $home_state, $polname, $imgurl, $social, $economic, $ap, $funds, $partyid);
        $stmt->fetch();
        $stmt->close();
        //$stmt = $con->prepare('SELECT  partyname FROM parties WHERE id = ?');
        //$stmt->bind_param('i', $partyid); // gets the id var from the current session, binds it to the
        //$stmt->execute();
        //$stmt->bind_result( $partyname);
        //$stmt->fetch();
        //$stmt->close();
        //broken party stuff

    } else {
        $con = OpenCon(); // opens a connection to the database, this function is from the above included script
        $stmt = $con->prepare('SELECT  influence, polstate, polname, imgurl, social, economic, action, funding, party FROM accounts WHERE id = ?');
        $stmt->bind_param('i', $id); // gets the id var from the current session, binds it to the
        $stmt->execute();
        $stmt->bind_result($influence, $home_state, $polname, $imgurl, $social, $economic, $ap, $funds, $partyid);
        $stmt->fetch();
        $stmt->close();
        //$stmt = $con->prepare('SELECT  partyname FROM parties WHERE id = ?');
        //$stmt->bind_param('i', $partyid); // gets the id var from the current session, binds it to the
        //$stmt->execute();
        //$stmt->bind_result( $partyname);
        //$stmt->fetch();
        //$stmt->close();
        //broken party stuff

    }
    return array($influence, $home_state, $polname, $imgurl, $social, $economic, $ap, $funds, $partyid);
}
?>
