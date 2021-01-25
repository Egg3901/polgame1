<?php

include 'navigation.php';
?>
<!DOCTYPE HTML>
<table>
    <th>Your Political Party</th>
    <th>Party Alignment</th>
    <?php
        $con = OpenCon(); // opens a connection to the database, this function is from the above included script
        $stmt = $con->prepare('SELECT polstate, polname FROM accounts WHERE id = ?');
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        $stmt->bind_result($polstate, $polname);

    ?>
</table>
<div class="main">
    <form action="adminscripts/increaserecognition.php">
        <div style=" width=20%; height=auto;">

            <button type="submit" ><br>
                <h1 style="margin: auto;"> Build Campaign Infrastructure</h1><br>
                <img src="img/mikeoffice" alt="camp image" style="margin:auto;" border=".5"><br>
                <p>Increasing your campaign infrastructure will increase your name recognition in your state. <br>
                        Campaign offices will distribute signs, and register volunteers to canvas.</p><br>
                <p><strong> Costs 5 actions, 0 funding. </strong></p>
        </div>
    </form>
    <form action="adminscripts/increasedonor.php">
        <div style=" width=20%; height=auto;">
            <button type="submit" ><br>
                <h1 style="margin: auto;"> Appeal To Grassroots Donors</h1><br>
                <img src="img/mikeoffice" alt="camp image" style="margin:auto;" border=".5"><br>
                <p>Appealing to grassroots donors increases your hourly income from them in the form of donations.<br>
                    Grasroots appeal is lowered by appealing to corporate donors, and is less effective for moderate candidates.</p><br>
                <p><strong> Costs 10 actions. </strong></p>
        </div>
    </form>
</div>


