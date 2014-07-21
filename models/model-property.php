<?php

$urlVars    = explode('/', $q);
$propertyId = $urlVars[1];

require_once('php/Properties.php');
$property = Properties::getProperty($propertyId);

if($property) {
    $file = 'property';
} else {
    $file = '404';
}