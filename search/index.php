<?php

require_once "../php-assets/config.php";

try {
    $term = filter_input(INPUT_GET,"search_term",FILTER_SANITIZE_STRING);
    $table = filter_input(INPUT_GET,"select",FILTER_SANITIZE_STRING);

    if (!empty($term) || !($term == "")){
        $searching = true;
    }
}catch (Exception $e){
    $searching = false;
}

$per_page = 6;
$page = empty($_GET['page']) ? 1 : $_GET['page'];

if ($searching){

    $limit = "LIMIT " . $per_page . " OFFSET " .  (($page - 1) * $per_page) ;
    $per_page = filter_input(INPUT_GET,"page",FILTER_SANITIZE_NUMBER_INT);

    if ($table == "poems"){
        $query = "SELECT id,heading FROM poems WHERE heading LIKE '%" . $term . "%' AND public = 1 " . $limit;
        $count_query = "SELECT COUNT(1) AS count FROM poems WHERE  heading LIKE '%" . $term . "%'" ;
    }
    else{
        $query = "SELECT id,CONCAT(name,' ' ,last_name) AS name FROM users WHERE name LIKE '%" . $term . "%' ". $limit;
        $count_query = "SELECT COUNT(1) AS count FROM users WHERE CONCAT(name,' ' ,last_name) LIKE '%" . $term . "%'" ;
    }
}

$data = $database->query($query);
$count_results = $database->query($count_query);

foreach ($count_results as $count){
    $count_results = $count['count'];
}


require "../php-assets/header.php";
?>

<main class="profile-site-background">
    <div class="overlay">
        <div></div>
    </div>
    <section class="main search-main">
        <h2 class="section-heading">VYHĽADÁVANIE</h2>
        <form action="index.php" method="get" id="search-form">
            <input type="text" name="search_term" id="search-term" placeholder="Text vyhľadávania...">
            <label for="">Vyhľadávať:</label>
            <select name="select" id="who-to-search">
                <option <?= $table == "poems" ? "selected" : "" ?> value="poems">Básne</option>
                <option <?= $table == "users" ? "selected" : "" ?> value="users">Požívaťeľov</option>
            </select>
            <button id="button" type="submit">Hľadať.</button>
        </form>
        <section class="poem-gallery">
            <h2>VÝSLEDKY</h2>
            <?php
            if ($searching && $table == "poems"){
                $data = $database->query($query);
                foreach ($data as $poem): ?>


                    <div class="poem">
                        <div class="heading-container">
                            <h3 class="heading"><?= $poem['heading'] ?></h3>
                        </div>
                        <a href="../poems/index.php?id=<?= $poem['id'] ?>">PREZERAŤ.</a>
                    </div>
                <?php endforeach;
            }
            else if ($searching && $table == "users"){
                $data = $database->query($query);
                foreach ($data as $user): ?>


                    <div class="poem">
                        <div class="heading-container">
                            <h3 class="heading"><?= $user['name'] ?></h3>
                        </div>
                        <a href="../profile/index.php?id=<?= $user['id'] ?>">PREZERAŤ.</a>
                    </div>
                <?php endforeach;
            }

            $per_page = 6;

            if ( $searching && $count_results > $per_page):
                $paginator_number = ceil($count_results / $per_page) ;


                ?>


                <div class="paginator">
                    <?php if ($page != 1): ?>
                    <div class="prev"><a href="index.php?search_term=<?= $term?>&page=<?= $limit - 1?>&select=<?= $table?>">PREDOŠLÉ.</a></div><!--

                --><?php endif; ?><!--

                --><?php for ($i = 1 ; $i <= $paginator_number; $i++) : ?><!--
                    --><div class="number"><a class="<?= $i == $page ? "active-element" : "" ?>" href="index.php?search_term=<?= $term?>&page=<?= $i?>&select=<?= $table?>"><?= $i?></a></div><!--
                --><?php endfor; ?><!--

                --><?php if (!($paginator_number - $page <= 0 )): ?><!--
                --><div class="next"><a href="index.php?search_term=<?= $term?>&page=<?= $limit + 1?>&select=<?= $table?>">ĎALŠIE.</a></div>
                <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
    </section>
    <div id="message-box"></div>
</main>


<?php require_once "../php-assets/footer.php" ?>

