<?php
/// functions for formatting information across the site
///
error_reporting(E_ALL);
ini_set('display_errors', 'on');

function formatPosition($position_int): array {
    if ($position_int <= 5) :
        $formattedsocial = "Very Right Wing";
    }

    if ($position_int <= 4){
        $formattedsocial = "Right Wing";
        $color = "#DD491B";
        return array($formattedsocial, $color);
    }

    if ($position_int <= 3){
        $formattedsocial = "Leans Right Wing";
        $color = "#DD491B";
        return array($formattedsocial, $color);
    }

    if ($position_int <= 1){
        $formattedsocial = "Center Right";
        $color = "#DD491B";
        return array($formattedsocial, $color);
    }

    if ($position_int <= 0){
        $formattedsocial = "Centrist";
        $color = "#DD491B";
        return array($formattedsocial, $color);
    }
    if ($position_int <= -1){
        $formattedsocial = "Center Left";
        $color = "#DD491B";
        return array($formattedsocial, $color);
    }
    if ($position_int <= -3){
        $formattedsocial = "Leans Left Wing";
        $color = "#DD491B";
        return array($formattedsocial, $color);
    }
    if ($position_int <= -4){
        $formattedsocial = "Left Wing";
        $color = "#DD491B";
        return array($formattedsocial, $color);
    }
    elseif ($position_int <= -5) {
        $formattedsocial = "Libertarian Left";
        $color = "#DD491B";
        return array($formattedsocial, $color);
    }



