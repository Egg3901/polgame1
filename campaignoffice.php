<?php

include 'navigation.php';
?>
<!DOCTYPE HTML>
<table>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 1fr 1fr 1fr;
            gap: 0px 0px;
            word-wrap: break-word;
            grid-template-areas:

    "-heavy -heavy -heavy"
    "campinf funding ."
    ". . .";
        }
        .-heavy { grid-area: -heavy; width: 100%; height:auto;}
        .campinf { grid-area: campinf; width: 31%; height:auto; }
        .funding { grid-area: funding; width: 31%; height:auto; }

    </style>

    <div class="grid-container">
        <div class="-heavy">
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
        </div>

        <div class="campinf">
            <form action="adminscripts/increaserecognition.php">
                <div>

                    <button type="submit" ><br>
                        <h1 style="margin: auto;"> Build Campaign Infrastructure</h1><br>
                        <img src="img/campaignoffice/mikeoffice" alt="camp image" style="margin:auto;" border=".5"><br>
                        <p>Increasing your campaign infrastructure will increase your name recognition in your state. <br>
                            Campaign offices will distribute signs, and register volunteers to canvas.</p><br>
                        <p><strong> Costs 5 actions, 0 funding. </strong></p>
                </div>
            </form>
        </div>

        <div class="funding">
            <form action="adminscripts/increasedonor.php">
                <div>
                    <button type="submit" ><br>
                        <h1 style="margin: auto;"> Appeal To Grassroots Donors</h1><br>
                        <img src="img/campaignoffice/donorbase" alt="donorbase image" style="width: 45%; height:auto;" border=".5"><br>
                        <p>Appealing to grassroots donors increases your hourly income from them in the form of<br>
                            donations. Grasroots appeal is lowered by appealing to corporate donors, and is <br>
                            less effective for moderate candidates.</p><br>
                        <p><strong> Costs 10 actions. </strong></p>
                </div>
            </form>
        </div>
    </div>



