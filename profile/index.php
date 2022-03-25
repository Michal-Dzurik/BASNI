<?php

    require_once "../php-assets/config.php";
    $id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_STRING);

    //user information
    $query = "SELECT CONCAT(name,' ',last_name) AS name,description FROM users WHERE id =" . $id;
    $data = $database->query($query);
    $my_profile = false;

    $filename = '../profile-pictures/' . $id . '.jpg';

    if (isset($_GET['public']) && $_GET['public'] == 0){
        $public_statement = false;

    } else {
        $public_statement = true;
    }

    if (file_exists($filename)) {
        $profile_photo = $filename;
    } else {
        $profile_photo = '../profile-pictures/no-picture.svg';
    }

    if ($data == false ){
        die("<h1>404 Not Found</h1>");
    }

    foreach ($data as $user){
        $user_name = $user['name'] ;
        $description = $user['description'];
        $followed_ids = $user['followed'];
    }

    if ($user_name == ""){
        die("<h1>404 Not Found</h1>");
    }

    if (isset($_SESSION) && !empty($_SESSION)){
        if ($_SESSION["id"] == $id){
            $my_profile = true;
        }
    }

    if (isset($_GET['page'])){
        $page = $_GET['page'] ;
    }
    else $page = 1;


    require_once "../php-assets/header.php";
?>

<main class="profile-site-background">
    <div class="overlay">
        <div></div>
    </div>
    <section class="main">
        <?php if ($my_profile):?>
            <a class="my-profile" href="edit.php?id=<?= $id ?>"><img src="../icon/edit.svg" alt="Upraviť"></a>
            <a class="my-profile profile-not-public <?= !$public_statement ? "active-element" : "" ?>" href="index.php?id=<?= $id ?>&public=<?= $public_statement ? 0 : 1 ?>&page=<?= $page  ?>">Nepublikované</a>

        <?php endif;?>
        <section class="profile clearfix">
            <a href="index.php?id=<?= $id ?>">
                <img class="profile-picture" src="<?= $profile_photo ?>" alt="Michal Dzurík">
            </a>
            <article class="about">
                <h2 class="name"><?= $user_name?></h2>
                <p id="description" class="description"><?= $description == null ? "Používaťeľ si nenastavil popisok" : $description ?></p>

            </article>
        </section>
        <section class="poem-gallery">
            <h2>Moje básne</h2>
            <?php


                $count_poet = 0;

                 $poems_per_page = 6;

                // poems informations
                if ($public_statement){
                    $query = "SELECT heading,id FROM poems WHERE owner_id = " . $id . " AND public = 1 LIMIT " . $poems_per_page . " OFFSET " . ($page - 1) * $poems_per_page;
                    $count_query = "SELECT COUNT(1) AS count  FROM poems WHERE  owner_id = " . $id . " AND public = 1";
                }
                else{
                    $query = "SELECT heading,id FROM poems WHERE owner_id = " . $id . " LIMIT " . $poems_per_page . " OFFSET " . ($page - 1) * $poems_per_page;
                    $count_query = "SELECT COUNT(1) AS count FROM poems WHERE  owner_id = " . $id ;
                }
                $data = $database->query($query);
                $count_poet = $database->query($count_query);

                foreach ($count_poet as $count){
                    $count_poet = $count['count'];
                }

                foreach ($data as $poem):  ?>


            <div class="poem">
                <div class="heading-container">
                    <h3 class="heading"><?= $poem['heading'] ?></h3>
                </div>
                <a href="../poems/index.php?id=<?= $poem['id'] ?>">PREZERAŤ.</a>
            </div>

            <?php endforeach;
                if ($count_poet > $poems_per_page):
                $paginator_number = ceil($count_poet / $poems_per_page);
                ?>


            <div class="paginator">
                <?php if ($page != 1): ?>
                <div class="prev"><a href="index.php?id=<?= $id?>&public=<?= $public_statement ? 1 : 0?>&page=<?= $page - 1?>">PREDOŠLÉ.</a></div><!--
                --><?php endif; ?><!--

                <?php for ($i = 1 ; $i <= $paginator_number; $i++) : ?>

                    --><div class="number"><a class="<?= $i == $page ? "active-element" : "" ?>" href="index.php?id=<?= $id?>&public=<?= $public_statement ? 1 : 0?>&page=<?= $i?>"><?= $i?></a></div><!--
                <?php endfor; ?>


                <?php if ($paginator_number - $page != 0): ?>
                --><div class="next"><a href="index.php?id=<?= $id?>&public=<?= $public_statement ? 1 : 0?>&page=<?= $page + 1?>">ĎALŠIE.</a></div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

    </section>
        <div id="message-box"></div>
</main>
    <div class="footer-after">

    </div>
    <script src="../js/profile.js"></script>

<?php require_once "../php-assets/footer.php"?>