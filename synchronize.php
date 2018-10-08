<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 03-Oct-18
 * Time: 5:47 PM
 */


$result = array();
$output = null;

// Get credentials
$user = $_POST['user'];
$password = $_POST['password'];

$documentRoot = $_SERVER['DOCUMENT_ROOT'];
$branch = 'development';

// Set the HOME variable
putenv('HOME=/home/top10');

$ret = exec("expect git-pull.exp '$documentRoot' '$user' '$password' '$branch'", $output, $return_var);
$result = array_merge($result, $output);

$json_encode = json_encode(array('ret' => $ret, 'output' => $result, 'return_var' => $return_var));

header('Content-Type: application/json');
echo $json_encode;
