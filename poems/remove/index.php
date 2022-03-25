<?php

include_once "../../php-assets/config.php";

$id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_STRING);

$query = "DELETE FROM poems WHERE id = " . $id;
$data = $database->query($query);

if ($data) echo "success";
else echo "error";