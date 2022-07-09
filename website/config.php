<?php

/**
 * @return string
 */
function fullUrl(): string
{
    $url = "";
    $localhost = "http://localhost/Solital/documentation/website/";
    #$localhost = "http://localhost" . $_SERVER['REQUEST_URI'];
    $online = $_SERVER['SERVER_NAME'];

    if ($online == 'localhost') {
        $url = $localhost;
    } else {
        $url = 'http://' . $online;
    }

    return $url;
}
