<?php

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

/*
function Tests($name)
{
    var_dump($name);
    die();
}*/