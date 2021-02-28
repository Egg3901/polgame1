<?php
/// functions for formatting information across the site
///


/**
 * @param $position * the economic/social position
 * @return array    * the position data
 */

function formatPosition($position): array
{{
    if ($position <= -5) : {
        $formatted_position = "Very Left Wing";
        $color = "#005CA2";
        return array($formatted_position, $color);
    } elseif ($position <= -4) : {
        $formatted_position = "Left Wing";
        $color = "#009BF8";
        return array($formatted_position, $color);
    }
    elseif ($position <= -3) : {
        $formatted_position = "Leans Left Wing";
        $color = "#6DACFE";
        return array($formatted_position, $color);
    }
    elseif ($position <= -1) : {
        $formatted_position = "Center Left";
        $color = "#A4CCFF";
        return array($formatted_position, $color);
    }

    elseif ($position <= 0) : {
        $formatted_position = "Centrist";
        $color = "#A5A5A5";
        return array($formatted_position, $color);
    }
    elseif ($position <= 1) : {
        $formatted_position = "Center Right";
        $color = "#FF9695 ";
        return array($formatted_position, $color);
    }
    elseif ($position <= 3) : {
        $formatted_position = "Leans Right Wing";
        $color = "#F56D6B";
        return array($formatted_position, $color);
    }
    elseif ($position <= 4) : {
        $formatted_position = "Right Wing";
        $color = "#FE3B38";
        return array($formatted_position, $color);
    }
    else: {
        $formatted_position = "Very Right Wing";
        $color = "#FD211D";
        return array($formatted_position, $color);
    }
    endif;
}}








