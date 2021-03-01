<?php
include 'connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 'on');
$con = OpenCon();
$state_id_query = 'FROM states SELECT name, population, govtime, wmcvotershare, wmctotalappeal, wmcecon, wmcsocial WHERE id = ?';
$stmt = $con->prepare($state_id_query);
$stmt->execute();
$stmt->fetch();
$stmt->close();
$result = $stmt->bind_result($state_name,$state_population,$gov_time_remaining, $wmc_voter_share, $wmc_total_appeal, $wmc_econ, $wmc_social);
foreach ($result as $row) {
    //iterates through every state

    $voter_turnout = .61;
    $voter_base = round(($state_population * $voter_turnout));
    $votes_added_per_update = round(($voter_base / $gov_time_remaining));

    function findCandidatesByRace($con, $state_name, $race_to_search): resource {
        $gov_candidates_query = 'FROM accounts SELECT influence, social, economic, party WHERE polstate = ? AND race = ?';
        $gov_query = $con->prepare($gov_candidates_query);
        $gov_query->bind_params('si',$state_name, $race_to_search);
        $gov_query->execute();
        $gov_query->fetch();
        $gov_query->close();
        return $gov_query->get_result();
    }

    function calculateDemographicAppeal($candidate_data, $wmc_total_appeal, $wmc_econ, $wmc_social): float {
        $candidate_influence = $candidate_data['influence'];
        $candidate_social_position = $candidate_data['social'];
        $candidate_economic_position = $candidate_data['economic'];
        $candidate_econ_distance = $candidate_economic_position - $wmc_econ;
        $candidate_social_distance = $candidate_social_position - $wmc_social;
        $candidate_appeal_to_demographic  = (
                100 - ($candidate_social_distance * 5) - ($candidate_econ_distance * 5))^2/200 * ($candidate_influence / 100
            );
        $wmc_total_appeal + $candidate_appeal_to_demographic;
        return $candidate_appeal_to_demographic;
    }
    function calculateVotesPerCandidate($candidate_result, $wmc_total_appeal, $candidate_appeal_to_demographic, $voterbase) {
        $votes_added = $voterbase / 288;
        $appeal_share = $candidate_result;
    }
    $array_of_race = arr(1, 2, 3); //gov, junior senate, senior senate respectively
    foreach ($array_of_race as &$race_param) {
        $candidates_in_race = findCandidatesByRace($con, $state_name, $race_param);
        foreach ($candidates_in_race as $candidate_result) {
            $candidate_appeal_to_demographic = calculateDemographicAppeal($candidate_result, $wmc_total_appeal, $wmc_econ, $wmc_social);
        }
        foreach ($candidates_in_race as $candidate_result) {
            calculateVotesPerCandidate($candidate_result, $wmc_total_appeal, $voter_base, $candidate_appeal_to_demographic);
        }
    }

}



