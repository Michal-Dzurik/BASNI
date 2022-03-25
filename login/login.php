<?php

require_once "../php-assets/config.php";

$query = "SELECT * FROM users";
// executing db query
$data = $database->query($query);

// getting informations
$email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_STRING);
$typed_password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_STRING);


if (is_array($data) || is_object($data)){
    foreach ($data as $user){
        if ($user["email"] === $email ){
            if (password_verify($typed_password, trim($user["password"]))){
                echo "success#" . $user["id"] ;

                $_SESSION["id"] = $user["id"];
                $_SESSION["name"] = $user["name"];
                $_SESSION["last_name"] = $user["last_name"];
                $_SESSION["age"] = $user["age"];
                $_SESSION["login"] = $user["login"];
            }
            else echo "password";

        } 

    } 
}




