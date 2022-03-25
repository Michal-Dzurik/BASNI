<?php

require_once "../../php-assets/config.php";
$id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);

if (isset($_SESSION) && !empty($_SESSION)){
    if ($_SESSION["id"] == $id){
        $my_profile = true;
    }
    else die("Toto nie je váš profil, takže ho nesmiete upravovať");
}
else die("Toto nie je váš profil, takže ho nesmiete upravovať");


$description = filter_input(INPUT_POST, "description",FILTER_SANITIZE_STRING);


$target_dir = "../../profile-pictures/" . $id . ".jpg";

if (isset($_FILES) && !empty($_FILES)){
    $file = $_FILES['file'];
    if ($file['size'] < 3000000 ) {
        if ($file['type'] == "image/jpeg") {
            if (file_exists($target_dir) ){
                unlink($target_dir);
            }
            if (move_uploaded_file($file['tmp_name'], $target_dir)) {
                $query = "UPDATE users SET description = '" . $description . "' WHERE id = " . $id ;
                $data = $database->query($query);

                if ($data){
                    echo "success#all";
                }
                else echo "database";

            } else echo "storage";

        }
        else echo "type";


    }

    else echo "size";
}
else{
    $query = "UPDATE users SET description = '" . $description . "' WHERE id = " . $id ;
    $data = $database->query($query);

    if ($data){
        echo "success#description";
    }
    else echo "database";
}




