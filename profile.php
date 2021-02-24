<?php

include 'navigation.php';
include 'common_functions/formatting_functions.php';
include 'common_functions/scrape_profile_data.php';
$id = $_GET['id'];
$viewer_id = $_SESSION['id'];
error_reporting(E_ALL);
ini_set('display_errors', 'on');



list($influence, $home_state, $fetchProfile($id, $viewer_id);


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
                <td><?=$actions?> actions remaining</td>
            </tr>
            <tr>
                <td>Funding:</td>
                <td><?=$funds?>$</td>
            </tr>

            <tr>
                <td>Location:</td>
                <td><a href="state.php?state=<?=$home_state?>"><?=$home_state?></a></td>
            </tr>
            <tr>
                <td>Social Position:</td>
                <td>
                    <?php

                    $position_data = formatPosition($position=$economic);
                    echo "
                    <p style='color: $position_data[1]'>". $position_data[0] . "</p>
                    "
                    ?>


                </td>
            </tr>  <!--- social position formatting ---->
            <tr>
                <td>Economic Position:</td>
                <td>
                    <?php
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
