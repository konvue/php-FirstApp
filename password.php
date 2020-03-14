<?php

require_once 'system.core';
include("includes/navigation.php");


$json = array();
$itemObject = new stdClass();
$itemObject->ip = "192.168.0.1";
$itemObject->port = 2016;

array_push($json, $itemObject);
$json = json_encode($json, JSON_PRETTY_PRINT);
echo $json;


$port = 24;
$database = 'localhost';
$env = 'root';
$password = 'fsociety15';


function searchMyCoolArray($arrays, $key, $search) {
    $count = 0;
 
    foreach($arrays as $object) {
        if(is_object($object)) {
           $object = get_object_vars($object);
        }
 
        if(array_key_exists($key, $object) && $object[$key] == $search) $count++;
    }
 
    return $count;
 }
 
 echo searchMyCoolArray($input, 'info_type_id', 4);


?>
