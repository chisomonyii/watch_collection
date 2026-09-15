<?php
require_once("config.php");

function assets($assets_file)
{
    echo ROOT_URL ."/assets/$assets_file";
}

function getUrl($url)
{
    return ROOT_URL . $url;
}