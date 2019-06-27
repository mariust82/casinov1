<?php

function normalize($name)
{
    $str = str_replace(" ", "-", $name);
    $str = str_replace("#", "-", $str);
    return strtolower($str);
}

function get_rating($score)
{
    if($score == 0) {
        $string = 'No score';
    } elseif($score >= 1 && $score <= 2.99) {
        $string = 'Terrible';
    } elseif($score >= 3 && $score <= 4.99) {
        $string = 'Poor';
    } elseif($score >= 5 && $score <= 6.99) {
        $string = 'Good';
    } elseif($score >= 7 && $score <= 8.99) {
        $string = 'Very good';
    } elseif($score >= 9 && $score <= 10) {
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
    //die();
}