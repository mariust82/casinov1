<?php
function getAbbreviation($name)
{
    $words = explode(" ", $name);
    $abbr = "";

    foreach ($words as $word) {
      $abbr .= $word[0];
    }
    return $abbr;
}

function setScoreClass($score) {
    $score = ceil($score);
    if ($score == 1 || $score == 2) {
        return "Terrible";
    } elseif ($score == 3 || $score == 4) {
        return "Poor";
    } elseif ($score == 5 || $score == 6) {
        return "Good";
    } elseif ($score == 7 || $score == 8) {
        return "Very Good";
    } elseif ($score == 9 || $score == 10) {
        return "Excellent";
    }
            
}

function containsCasino($name)
{
    return strpos($name, 'Casino');
}

function getCasinoLogo($name, $resolution) {
    return "/public/sync/casino_logo_light/".$resolution."/".strtolower(str_replace(" ", "_", $name)).".png";
}

function getGameLogo($name, $resolution) {
    return "/public/sync/game_ss/".$resolution."/".str_replace(" ", "_", $name)."_ss.jpg";
}

function normalize($name)
{
    $str = str_replace(" ", "-", $name);
    $str = str_replace("#", "-", $str);
    return strtolower($str);
}

function get_string($name)
{
    return implode(", ", $name);
}

function get_rating($name)
{
    if ($name > 8) {
        $string = 'Excellent';
    } elseif($name > 6 && $name <= 8){
        $string = 'Very good';
    } elseif($name > 4 && $name <= 6){
        $string = 'Good';
    } elseif($name > 2 && $name <= 4){
        $string = 'Poor';
    } elseif($name == 0) {
        $string = 'No score';
    } else {
        $string = 'Terrible';
    }

    return $string;
}

function get_country_status($name)
{
    if ($name) {
        $string = 'accepted';
    } else {
        $string = 'not accepted';
    }

    return $string;
}

function get_page_type()
{
    $position = strpos($_SERVER["REQUEST_URI"],"/",1);
    $url = ($position?substr($_SERVER["REQUEST_URI"],1, $position-1):$_SERVER["REQUEST_URI"]);
    switch ($url) {
        case 'casinos':
            $piece = 'label';
            break;
        case 'softwares':
            $piece = 'software';
            break;
        case 'bonus-list':
            $piece = 'bonus_type';
            break;
        case 'countries-list':
            $piece = 'country';
            break;
        case 'compatability':
            $piece = 'compatibility';
            break;
        case 'banking':
            $piece = 'banking_method';
            break;
        case 'features':
            $piece = 'feature';
            break;
    }
    return $piece;
}

function format_filter_date($date, $format = 'd.m.Y')
{
    return date($format, strtotime($date));
}