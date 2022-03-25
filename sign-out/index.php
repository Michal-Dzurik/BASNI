<?php

     require_once "../php-assets/config.php";

     $site = $_SERVER['HTTP_REFERER'] ;

     $location = "Location: " . $site . "";

if (session_destroy()){
    header($location);
}