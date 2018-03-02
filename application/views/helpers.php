<?php
/**
 * Prepares entity name to be used as path parameter.
 *
 * @param $name
 * @return string
 */

function check_user_agent ( $type = NULL ) {
       $user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
       if ( $type == 'bot' ) {
               // matches popular bots
               if ( preg_match ( "/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent ) ) {
                       return true;
                       // watchmouse|pingdom\.com are "uptime services"
               }
       } else if ( $type == 'browser' ) {
               // matches core browser types
               if ( preg_match ( "/mozilla\/|opera\//", $user_agent ) ) {
                       return true;
               }
       } else if ( $type == 'mobile' ) {
               // matches popular mobile devices that have small screens and/or touch inputs
               // mobile devices have regional trends; some of these will have varying popularity in Europe, Asia, and America
               // detailed demographics are unknown, and South America, the Pacific Islands, and Africa trends might not be represented, here
               if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) ) {
                       // these are the most common
                       return true;
               } else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) ) {
                       // these are less common, and might not be worth checking
                       return true;
               }
       }
       return false;
}

function detect_casinos_word($name)
{
    return strpos($name, 'Casinos');
}

function detect_casino_word($name)
{
    return strpos($name, 'Casino');
}

function normalize($name)
{
    $str = str_replace(" ", "-", $name);
    $str = str_replace("#", "-", $str);
    return strtolower($str);
}

function normalize_logo($name)
{
    $str = str_replace(" ", "_", $name);
    $str = str_replace("#", "_", $str);
    return strtolower($str);
}

function normalize_game($name)
{
    $str = str_replace(" ", "_", $name);
    $str = str_replace("#", "_", $str)."_ss";
    return $str;
}

function get_active($page, $item)
{
    $class = "";
    if ($page == $item) {
        $class = "active";
    }
    return $class;
}

function get_arr_from_string($name)
{
    $name = explode(",", $name);
    return $name[0];
}

function get_length_arr_from_string($name)
{
    $name = explode(",", $name);
    return count($name);
}

function get_string($name)
{
    $string = array();

    foreach ($name as $key => $value) {
        $string[$key] = $value;
    }

    return $string = implode(", ", $string);
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

function get_flags_dir()
{
    $dir = "/public/build/images/flags";
    return $dir;
}


function get_img_dir()
{
    $dir = "/public/sync";
    return $dir;
}

function get_public_dir()
{
    $dir = "/public/build";
    return $dir;
}

function get_external_url()
{
    $dir = "/link";
    return $dir;
}

function get_page_type()
{
    $url = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

    $pieces = explode("/", $url["path"]);

    switch ($pieces[1]) {
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

function get_top_url($name, $type = 'country')
{
    if (function_exists("get_top_" . $type . "_url")) {
        $func = "get_top_" . $type . "_url";
        return $func($name);
    }
    return '/' . $type . '/top-10-' . normalize($name) . '-casinos';
}

function get_top_banking_url($name)
{
    $name = normalize($name);
    switch ($name) {
        case 'skrill-moneybookers':
            $name = 'skrill';
            break;
        case 'ecopayz-ecocard':
            $name = 'ecopayz';
            break;
    }
    return "/banking/top-10-$name-casinos";
}


function get_top_country_url($country_name)
{
    $country_name = normalize($country_name);
    switch ($country_name) {
        case 'united-states':
            $country_name = 'usa';
            break;
        case 'united-kingdom':
            $country_name = 'uk';
            break;
        case 'south-africa':
            $country_name = 'south-african';
            break;
        case 'australia':
            $country_name = 'australian';
            break;
        case 'canadia':
            $country_name = 'canadian';
            break;
    }
    return "/country/top-10-$country_name-online-casinos";
}

function get_bonus_from_code($code)
{
    $code = ucwords(str_replace('_', ' ', $code)) . ' Bonus';
    return $code;
}

// function get_num_of_char($str) {
//     return strlen($str);
// }