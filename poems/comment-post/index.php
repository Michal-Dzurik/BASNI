<?php

include_once "../../php-assets/config.php";

$author_id = filter_input(INPUT_GET,"author_id",FILTER_SANITIZE_NUMBER_INT);
$poem_id = filter_input(INPUT_GET,"poem_id",FILTER_SANITIZE_NUMBER_INT);
$text = filter_input(INPUT_GET,"comment",FILTER_SANITIZE_STRING);

$query = "INSERT INTO comments (author_id,poem_id,text) VALUES (" . $author_id . "," . $poem_id .",'" . $text . "')";
$data = $database->query($query);

if ($data) echo "success";
else echo "error";
