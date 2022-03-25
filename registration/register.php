<?php

require_once "../php-assets/config.php";

$first_name = filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING);
$last_name = filter_input(INPUT_POST,"last_name",FILTER_SANITIZE_STRING);
$login = filter_input(INPUT_POST,"login",FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
$age = filter_input(INPUT_POST,"age",FILTER_SANITIZE_NUMBER_INT);
$password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING);
// password encrition
$password = password_hash($password, PASSWORD_DEFAULT);

$data = $database->query("SELECT login,email FROM users");
$login_exist = false;
$email_exist = false;

foreach ($data as $user){
    if ($user['email'] == $email){
        $email_exist = true;
    }
    if ($user['login'] == $login){
        $login_exist = true;
    }
}

// creating DB query
$query = "INSERT INTO users (name , last_name, email, age, login, password) VALUES ( '" . $first_name. "' , '" . $last_name . "' , '" . $email . "' , '" . $age . "' , '" . $login . "' , '" . $password ."	' ) ON DUPLICATE KEY UPDATE id = id";



if (!$login_exist && !$email_exist){
    //inserting to DB
    $query = $database->query($query) ? true : false;

    if ($query){
        echo "success";
    }
    else echo "database";

}
else if ($login_exist && $email_exist){
    echo "login & email";
}
else if ($login_exist ){
    echo "login";
}
else if (!$login_exist ){
    echo "email";
}





