<?php
function normalize($name)
{
    return strtolower(str_replace([' ', '#'], "-", $name));
}

function countryNormalize($name)
{
   return strtolower(str_replace(" ", "-", str_replace(["(",")","'"],["","",""], $name)));
}

function parse_video($url)
{
    return str_replace("youtu.be", "youtube.com/embed", $url);
}

function get_rating($score)
{
    $string = "";
    $score = ceil($score);
    if (!$score || $score < 1) {
        $string = 'No score';
    } elseif ($score >= 1 && $score < 3) {
        $string = 'Terrible';
    } elseif ($score >= 3 && $score < 5) {
        $string = 'Poor';
    } elseif ($score >= 5 && $score < 7) {
        $string = 'Good';
    } elseif ($score >= 7 && $score < 9) {
        $string = 'Very good';
    } elseif ($score >= 9) {
        $string = 'Excellent';
    }

    return $string;
}

function h2_to_tile($text)
{
    return preg_replace("/(-{3})(.*)(-{3})/", "<h2 class=\"text-title\"><span>$2</span></h2>", $text);
}

function datef($date)
{
    return date('M d, Y', strtotime($date));
}


function format_filter_date($date, $format = 'd.m.Y')
{
    return date($format, strtotime($date));
}

function Tests($name)
{
    var_dump($name);
    //die();
}

function getCasinoLogo($name, $width, $height)
{
    $resolution = $width . 'x' . $height;
    $logoDirPath = "/public/sync/casino_logo_light/".$resolution;
    $logoFile = strtolower(str_replace(" ", "_", $name)).".png";
    $logo = $logoDirPath.'/'.$logoFile;

    if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$logo)) {
        $logo ="/public/build/images/default_casino_logo.png";
    }

    return $logo;
}

function checkForAbbr($amount) {
    if (strpos($amount, 'FS') !== false) {
        return str_replace("FS",'<abbr title="Free Spins"> FS',$amount);
    }
    if (strpos($amount, 'NDB') !== false) {
        return str_replace("NDB",'<abbr title="No Deposit Bonus"> NDB',$amount);
    }
    if (strpos($amount, 'CB') !== false) {
        return str_replace("CB",'<abbr title="Cashback "> CB',$amount);
    }
    if (strpos($amount, 'FDB') !== false) {
        return str_replace("FDB",'<abbr title="First Deposit Bonus"> FDB',$amount);
    }
    return $amount;
}

function getAbbreviation($name, $amount)
{
    if(!preg_match('[FS|NDB|CB|FDB]', $amount) && !empty($name) && !empty($amount)){
        $words = explode(" ", $name);
        $abbr = "";

        foreach ($words as $word) {
            $abbr .= $word[0];
        }
        return $abbr;
    }
    return '';
}

function formatDate($date)
{
    if ($date != NULL) {
        $date_arr = explode('-', $date);
        $month_name = date('M', strtotime($date));
        return $month_name.' '.$date_arr[2].', '.$date_arr[0];
    } return "None";
}

function gamesAllowed($games) {
    return explode(",", $games);
}

function gameNames($games){
    
    $gamesArray = explode(",", $games);
        if (count($gamesArray) > 1){
            return substr($games,0, 12) . '...';
        }elseif (strlen($games) > 22){
            return substr($games,0, 22) . '...';
        }else{
            return $games;
        }
}

function getBankingTitles($name, $index)
{
    $counter=0;
    $items = [];
    foreach ($name as $key => $item) {
        if ($counter >= $index) {
            $items[$key] = $key;
        }
        $counter++;
    }
    return implode(", ", $items);
}

function get_string($name, $index)
{
    $items = [];
    foreach ($name as $key => $item) {
        if ($key > $index-1) {
            $items[$key] = $item;
        }
    }
    return implode(", ", $items);
}

function checkGameAvailability($casinoGameTypes) {
    $games = [
        "Blackjack" => 0,
        "Roulette" => 0,
        "Slots" => 0,
        "Video Poker" => 0,
        "Craps" => 0,
        "Baccarat" => 0,
        "Bingo" => 0,
        "Keno" => 0,
        "Table Games" => 0,
        "Scratch Cards" => 0
    ];

    if(!empty($casinoGameTypes)) {
        foreach ($casinoGameTypes as $type) {
            $games[$type['name']] = in_array($type['name'], $games) ? 1 : 0;
        }
    }
    return $games;
}

function setVotePercents($vote, $total_votes){
    $percent  = round( ( $vote / $total_votes ) * 100);
    return $percent . '%';
}

function kFormater($number){
    if ($number >= 1000) {
        return round($number/ 1000, 1) . 'K';
    }
    return $number;
}

function get_bonus_from_code($code)
{
    $code = ucwords(str_replace('_', ' ', $code)) . ' Bonus';
    return $code;
}
