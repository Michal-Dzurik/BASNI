<?php

require_once "../php-assets/config.php";


$per_page = 6;

$data = $database->query("SELECT followed FROM users WHERE id = " . $_SESSION['id']);
foreach ($data as $flw){
    $followed_ids = explode("#",filter_ids($flw["followed"]));
}

if (isset($_GET['page'])){
    $page = $_GET['page'] ;
}
else $page = 1;

// podľa prvej query to pojde


require "../php-assets/header.php";
?>

<main class="profile-site-background">
    <div class="overlay">
        <div></div>
    </div>
    <section class="main news-main">
        <h2 class="section-heading">NOVINKY</h2>
        <section class="poem-gallery">
            <?php

            $per_page = 6;

            $query = "SELECT p.id,p.owner_id,p.heading,p.content, CONCAT(u.name,' ',u.last_name) AS full_name FROM poems p JOIN users u ON u.id = p.owner_id WHERE p.owner_id IN " . create_id_for_sql($followed_ids). " AND p.public = 1 ORDER BY p.date DESC LIMIT " . $per_page . " OFFSET " . ($page - 1) * $per_page;
            $data = $database->query($query);

            $c = $database->query("SELECT COUNT(1) as count FROM poems WHERE owner_id IN " . create_id_for_sql($followed_ids). " AND public = 1");
            foreach ($c as $count){
                $count_results = $count['count'];
            }

            foreach ($data as $poem): ?>
                    <div class="post">

                        <h3 class="heading"><a href="../poems/index.php?id=<?= $poem['id'] ?>"><?= $poem['heading'] ?></a><a href="../profile/index.php?id=<?= $poem['owner_id'] ?>" class="post-author"><?= $poem['full_name'] ?></a></h3>
                        <p><?= $poem['content'] ?></p>



                    </div>


                <?php endforeach;


            if ( $count_results > $per_page):
                $paginator_number = ceil($count_results / $per_page) ;


                ?>


                <div class="paginator">
                    <?php if ($page != 1): ?>
                    <div class="prev"><a href="index.php?page=<?= $page - 1?>">PREDOŠLÉ.</a></div><!--

                --><?php endif; ?><!--

                --><?php for ($i = 1 ; $i <= $paginator_number; $i++) : ?><!--
                    --><div class="number"><a class="<?= $i == $page ? "active-element" : "" ?>" href="index.php?page=<?= $i?>"><?= $i?></a></div><!--
                --><?php endfor; ?><!--

                --><?php if (!($paginator_number - $page <= 0 )): ?><!--
                --><div class="next"><a href="index.php?page=<?= $page + 1?>">ĎALŠIE.</a></div>
                <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
    </section>
    <div id="message-box"></div>
</main>


<?php require_once "../php-assets/footer.php" ?>

