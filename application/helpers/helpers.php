<?php
function normalize($name)
{
    $str = str_replace(" ", "-", $name);
    $str = str_replace("#", "-", $str);
    return strtolower($str);
}

function parse_video($url)
{
    return str_replace("youtu.be", "youtube.com/embed", $url);
}

function get_rating($score)
{
    if ($score == 0) {
        $string = 'No score';
    } elseif ($score >= 1 && $score <= 2.99) {
        $string = 'Terrible';
    } elseif ($score >= 3 && $score <= 4.99) {
        $string = 'Poor';
    } elseif ($score >= 5 && $score <= 6.99) {
        $string = 'Good';
    } elseif ($score >= 7 && $score <= 8.99) {
        $string = 'Very good';
    } elseif ($score >= 9 && $score <= 10) {
        $string = 'Excellent';
    }

    return $string;
}

function h2_to_tile($text)
{
    $p = preg_replace("/(-{3})(.*)(-{3})/", "<h2 class=\"text-title\"><span>$2</span></h2>", $text);
    return $p;
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
}

function formatDate($date)
{
    if ($date != NULL) {
        $date_arr = explode('-', $date);
        $month_name = date('M', strtotime($date));
        return $month_name.' '.$date_arr[2].', '.$date_arr[0];
    } return "None";
}
