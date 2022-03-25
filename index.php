<?php
    require "php-assets/config.php";

if (isset($_SESSION) && !empty($_SESSION)){
    header("Location:" . ROOT . "edit");
}
else{
    header("Location:" . ROOT . "about");
}