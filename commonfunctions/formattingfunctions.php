<?php
/// functions for formatting information across the site
///
error_reporting(E_ALL);
ini_set('display_errors', 'on');

/**
 * @param $position * the economic/social position
 * @return array    * the position data
 */

function formatPosition($position): array
{
    if ($position <= 5) : {
        $formatted_position = "Very Right Wing";
        $color = "#DD491B";
        return array($formatted_position, $color);
    } elseif ($position <= 4) : {
        $formatted_position = "Right Wing";
        $color = "#DD491B";
        return array($formatted_position, $color);
    } elseif ($position <= 3) : {
        $formatted_position = "Leans Right Wing";
        $color = "#DD491B";
        return array($formatted_position, $color);
    }

    elseif ($position <= 1) : {
        $formatted_position = "Center Right";
        $color = "#DD491B";
        return array($formatted_position, $color);
    }

    elseif ($position <= 0) : {
        $formatted_position = "Centrist";
        $color = "#DD491B";
        return array($formatted_position, $color);
    }
    elseif ($position <= -1) : {
        $formatted_position = "Center Left";
        $color = "#DD491B";
        return array($formatted_position, $color);
    }
    elseif ($position <= -3) : {
        $formatted_position = "Leans Left Wing";
        $color = "#DD491B";
        return array($formatted_position, $color);
    }
    elseif ($position <= -4) : {
        $formatted_position = "Left Wing";
        $color = "#DD491B";
        return array($formatted_position, $color);
    }
    elseif ($position <= -5) : {
        $formatted_position = "Libertarian Left";
        $color = "#DD491B";
        return array($formatted_position, $color);
    }
    endif;
}



