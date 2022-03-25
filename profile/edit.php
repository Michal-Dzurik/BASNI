<?php

    require_once "../php-assets/config.php";
    $id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_STRING);

    if (isset($_SESSION) && !empty($_SESSION)){
        if ($_SESSION["id"] == $id){
            $my_profile = true;
        }
        else die("Toto nie je váš profil, takže ho nesmiete upravovať");
    }
    else die("Toto nie je váš profil, takže ho nesmiete upravovať");

    //user information
    $query = "SELECT description FROM users WHERE id =" . $id;
    $data = $database->query($query);

    $filename = '../profile-pictures/' . $id . '.jpg';

    if (file_exists($filename)) {
        $profile_photo = $filename;
    } else {
        $profile_photo = '../profile-pictures/no-picture.svg';
    }

    foreach ($data as $user){
        $description = $user['description'];
    }

    require "../php-assets/header.php";
?>

<div class="nav-after">

</div>
<main class="profile-site-background">
    <div class="overlay">
        <div></div>
    </div>
    <section class="main-profile-edit clearfix">
        <form id="form" action="edit/index.php" method="post" class="clearfix" enctype="multipart/form-data">
            <input id="id" type="hidden" name="id" value="<?= $id ?>">
            <h2 class="section-heading">ÚPRAVA<span>.</span></h2>
            <h3>Popis</h3>
            <textarea name="description" id="description" maxlength="200" cols="30" rows="10"><?= $description ?></textarea>
            <h3>Profilová fotka</h3>
            <img src="<?=$filename ?>" alt="ešte ste nemali profilovú fotku">
            <div class="file-container">
                <input id="file" type="file" name="file">
                <label for="file">Vyberte fotku</label>
                <label class="label" for="file"></label>
            </div>


            <button type="submit" id="button">UPRAVIŤ.</button>
        </form>

    </section>
    <div id="message-box"></div>
</main>

<script src="../js/profileEdit.js"></script>

<?php require_once "../php-assets/footer.php" ?>
