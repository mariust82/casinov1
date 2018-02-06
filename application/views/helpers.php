<?php
/**
 * Prepares entity name to be used as path parameter.
 *
 * @param $name
 * @return string
 */

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

function get_string($name)
{
    $string = array();

    foreach ($name as $key => $value) {
        $string[$key] = $value;
    }

    return $string = implode(", ", $string);
}

function get_img_dir()
{
    $dir = "/public/build/images";
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

    return $pieces = explode("/", $url["path"]);
}

function format_filter_date($date, $format = 'F Y')
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