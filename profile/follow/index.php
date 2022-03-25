<?php

include_once "../../php-assets/config.php";

$id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_NUMBER_INT);
$status = filter_input(INPUT_POST,"status",FILTER_SANITIZE_STRING);

$query = "SELECT followed FROM users WHERE id =" . $_SESSION['id'];
$data = $database->query($query);

foreach ($data as $followed){
    $followed_ids = $followed[0];
}

if ($status === "followed"){
    $followed_ids = remove_followed_id($id,$followed_ids);
}
else if($status === "notfollowed"){
    $followed_ids = add_followed_id($id,$followed_ids);

}
else{
    die("errorsd");
}

$query = "UPDATE users SET followed = '" . $followed_ids . "' WHERE id =" . $_SESSION['id'];
$data = $database->query($query);

if ($data->rowCount() == 0){
    die("error");
}
else{
    die("success");
}


