<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
//
include 'common_functions/navigation.php';
include 'common_functions/formatting_functions.php';
include 'common_functions/scrape_profile_data.php';

// fetch profile ID from link
$profile_id =urlencode( $_GET['id']);
// fetch profile data based on id
list ($influence, $politician_name, $home_state, $img_path, $social, $economic, $actions, $funds, $party_id) = fetchProfile($profile_id);
//$influence = $profile_data_array[0];
//$politician_name = $profile_data_array[2];
//$home_state = $profile_data_array[1];
//$img_path = $profile_data_array[3];
//$social = $profile_data_array[4];
//$economic = $profile_data_array[5];
//$actions = $profile_data_array[6];
//$funds = $profile_data_array[7];
//$party_id = $profile_data_array[8];
//
?>
<div class="main-container" id="profile-main-container">
    <div class="profile-container">
        <h2 id="politician-name"> <?=$politician_name?> </h2>
        <br>
        <img class="profile-image" src="<?=$img_path?>" alt="your profile image">
        <table id="politician-table" class="info-table">
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

</html>


