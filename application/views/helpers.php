<?php

/*

function containsCasino($name)
{
    return strpos($name, 'Casino');
}

function get_string($name)
{
    foreach ($name as $key => $item) {
        if ($key != 0) {
            $items[$key] = $item;
        }
    }
    return implode(", ", $items);
}

function setScoreClass($score) {
    if ($score >= 1 && $score <= 4.99) {
        return "Poor";
    } elseif ($score >= 5 && $score <= 7.99) {
        return "Good";
    } elseif ($score >= 8 && $score <= 10) {
        return "Excellent";
    }
}

function getAbbreviation($name)
{
    $words = explode(" ", $name);
    $abbr = "";

    foreach ($words as $word) {
        $abbr .= $word[0];
    }
    return $abbr;
}


function getCasinoLogo($name, $resolution) {

    $logoDirPath = "/public/sync/casino_logo_light/".$resolution;
    $logoFile = strtolower(str_replace(" ", "_", $name)).".png";
    $logo = $logoDirPath.'/'.$logoFile;

    if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$logo)){
        $logo =$logoDirPath."/no-logo-{$resolution}.png";
    }
    return $logo;
}

!!!!!!!!!!!!!!!!
function getGameLogo($name, $resolution) {
    return "public/sync/game_ss/".$resolution."/".str_replace(" ", "_", $name)."_ss.jpg";
}

function getGameTypeLogo($name, $resolution) {
    return "/public/sync/game_type_logo/".$resolution."/".strtolower(str_replace(" ", "_", $name)).".jpg";
}


function getSoftwareLogo($name, $resolution) {
    return "/public/sync/software_logo_light/".$resolution."/".strtolower(str_replace(" ", "_", $name)).".png";
}

function get_page_type()
{
    $position = strpos($_SERVER["REQUEST_URI"],"/",1);
    $url = ($position?substr($_SERVER["REQUEST_URI"],1, $position-1):$_SERVER["REQUEST_URI"]);
    $page = substr($_SERVER["REQUEST_URI"], $position+1);
    if ($page === 'no-deposit-bonus') {
        return 'free_bonus';
    }
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
        case 'banking':
            $piece = 'banking_method';
            break;
        case 'features':
            $piece = 'feature';
            break;
    }
    return $piece;
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

*/

function normalize($name)
{
    $str = str_replace(" ", "-", $name);
    $str = str_replace("#", "-", $str);
    return strtolower($str);
}

function get_rating($name)
{
    if($name == 0) {
        $string = 'No score';
    } elseif($name >= 1 && $name <= 4.99) {
        $string = 'Poor';
    } elseif($name >= 5 && $name <= 7.99) {
        $string = 'Good';
    } elseif($name >= 8 && $name <= 10) {
        $string = 'Excellent';
    }

    return $string;
}


function format_filter_date($date, $format = 'd.m.Y')
{
    return date($format, strtotime($date));
}

function Tests($name)
{
    var_dump($name);
    die();
}