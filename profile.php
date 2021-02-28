<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
$id = $_GET['id'];
include 'navigation.php';
include 'commonfunctions/formattingfunctions.php';





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
