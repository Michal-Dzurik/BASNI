<?php
    require_once "../../php-assets/config.php";

    if (isset($_POST['id']) && $_POST['id'] !== ""){
        $update = true;
        $poem_id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_NUMBER_INT);
    }else $update = false;


$heading = filter_input(INPUT_POST,"poem_heading",FILTER_SANITIZE_STRING);
$content = filter_input(INPUT_POST,"poem_content",FILTER_SANITIZE_STRING);
$public = filter_input(INPUT_POST,"public",FILTER_SANITIZE_STRING);
$owner_id = $_SESSION['id'];

if (!$update){
    $query = "INSERT INTO poems (heading,content,public,owner_id) VALUES ('" . $heading . "','" . $content . "', " . ($public ? 1 : 0 ). ", " . $owner_id .")";
}
else{
    $query = "UPDATE poems SET heading = '" . $heading . "', content = '" . $content . "', public = " . ($public ? 1 : 0) . " WHERE id = " . $poem_id;
}

$data = $database->query($query);

if ($data) {
    if (!$poem_id){
        $data = $database->query("SELECT id FROM poems WHERE owner_id = " . $owner_id . " ORDER BY date DESC LIMIT 1");
        foreach ($data as $id){
            echo "success#" . $id['id'];
        }
    } else echo "success";

}
else echo "error";

