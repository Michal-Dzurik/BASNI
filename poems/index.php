<?php
include_once "../php-assets/config.php";

$id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);
$user_name = false;

//user information
$query = "SELECT CONCAT(u.name, ' ', u.last_name) AS name,p.id, p.heading, p.content, p.owner_id FROM poems p JOIN users u ON p.owner_id = u.id WHERE p.id =" . $id;
$data = $database->query($query);


    if ($data == false ){
        die("<h1>404 Not Found</h1>");
    }

    foreach ($data as $user){
        $user_name = $user['name'] ;
        $description = $user['description'];
        $owner_id = $user['owner_id'];
        $heading = $user['heading'];
        $content = $user['content'];
    }

    $filename = '../profile-pictures/' . $owner_id . '.jpg';

    if (file_exists($filename)) {
        $profile_photo = $filename;
    } else {
        $profile_photo = '../profile-pictures/no-picture.svg';
    }

    if (!$user_name){
        die("<h1>404 Not Found</h1>");
    }

    if (isset($_SESSION) && !empty($_SESSION)){
        if ($_SESSION["id"] === $owner_id){
            $my_profile = true;
        }
    }

include "../php-assets/header.php";
?>
<main class="profile-site-background">
    <div class="overlay">
        <div></div>
    </div>
    <section class="main">
        <?php if ($my_profile): ?>
        <a class="my-profile" href="../edit/index.php?id=<?= $id ?>"><img src="../icon/edit.svg" alt="Upraviť"></a>
        <?php endif;
                if ($my_profile): ?>
        <a id="remove" class="my-profile profile-remove" href="remove/index.php?id=<?= $id ?>"><img src="../icon/remove.svg" alt="Upraviť"></a>
        <?php endif; ?>
        <section class="profile clearfix">
            <a href="../profile/index.php?id=<?= $owner_id ?>">
                <img class="profile-picture" src="<?= $profile_photo ?>" alt="Michal Dzurík">
            </a>
            <article class="about">
                <p><?= $user_name ?></p>
                <h2 class="name"><?= $heading ?></h2>
            </article>
        </section>
        <section class="main-poem">
            <p><?= $content ?></p>
            <section id="comments">
                <h2 class="section-heading">Komentáre</h2>
                <?php
                    $query = "SELECT c.text,CONCAT(u.name, ' ',u.last_name) AS name,u.id FROM comments c JOIN users u ON c.author_id = u.id WHERE c.poem_id = " . $id;
                    $data = $database->query($query);

                    foreach ($data as $comment):
                ?>
                <div class="comment">
                    <h4><a href="../profile/index.php?id=<?= $comment['id'] ?>"><?= $comment['name'] ?></a></h4>
                    <p><?= $comment['text'] ?></p>
                </div>
                <?php endforeach; ?>
            </section>
            <section id="commenting">

                <form id="comment-form" action="comment-post/index.php" method="get">
                    <input type="hidden" id="name" value="<?= $_SESSION['name'] ? ($_SESSION['name'] . ' ' . $_SESSION['last_name']) : "Anonymus" ?>">
                    <input type="hidden" id="poem_id" name="poem_id" value="<?= $id ?>">
                    <input type="hidden" id="author_id" name="author_id" value="<?= $_SESSION['id'] ? $_SESSION['id'] : "Anonymus" ?>">
                    <textarea id="newComment" name="comment" placeholder="Komentár..."></textarea>

                    <button type="submit" id="submit">ODOSLAŤ.</button>
                </form>
            </section>
        </section>
        <div id="message-box"></div>
    </section></main>

<div class="footer-after">

</div>

<script src="../js/poemProfile.js"></script>

<?php include "../php-assets/footer.php"?>