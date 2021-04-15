<?php

/**
 * @return string
 */
function fullUrl(): string
{
    $url = "";
    $localhost = "http://localhost/Solital/documentation";
    $online = $_SERVER['SERVER_NAME'];

    if ($online == 'localhost') {
        $url = $localhost;
    } else {
        $url = 'http://' . $online;
    }
    
    return $url;
}
