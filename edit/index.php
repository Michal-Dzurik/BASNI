<?php

require_once "../php-assets/config.php";

if(isset($_GET) && isset($_GET["id"]) && $_GET["id"] != null){
    $id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT heading,content,owner_id FROM poems WHERE id = " . $id ;
    $data = $database->query($query);

    foreach ($data as $poem){
        if ($poem['owner_id'] == $_SESSION['id']){
            $found = true;

            $content = $poem['content'];
            $heading = $poem['heading'];
        }
        else $found = false;

    }
}



require_once "../php-assets/header.php";?>


<header>
    <a id="save" href="save/">Uložiť</a>
    <a id="save-public" href="save/">Uložiť a publikovať</a>
</header>
<main id="app" class="profile-site-background background-edit clearfix">
    <div class="overlay">
        <div></div>
    </div>

    <?php if ($found) : ?>

    <article id="notebook">
        <form action="save/index.php" method="post" id="poem-form">
            <input type="hidden" id="poem_id" name="id" value="<?= $id ?>">
            <input placeholder="Názov..." id="poem_heading" type="text" name="poem_heading" value="<?= $heading?>">
            <textarea placeholder="Báseň..." spellcheck="false" name="poem_content" id="text" cols="30" rows="10"><?= $content?></textarea>
            <div id="syllable-handler"></div>
        </form>

    </article>

    <?php endif?>

    <?php if (!$found) : ?>

        <article id="notebook">
            <form action="save/index.php" method="post" id="poem-form">
                <input type="hidden" id="poem_id" name="id">
                <input placeholder="Názov..." id="poem_heading" type="text" name="poem_heading">
                <textarea placeholder="Báseň..." spellcheck="false" name="poem_content" id="text"></textarea>
                <div id="syllable-handler"></div>
            </form>
        </article>

    <?php endif?>

    <div class="features">
        <div id="rhyme-search">
            <h3>Vyhľadávač rýmov</h3>
            <form action="https://mikel-web.000webhostapp.com/rhymes/" method="get" id="rhyme-form">
                <input placeholder="Slovo na rým" type="text" id="rhyme-string" name="rhyme_string">
                <label for="">Počet výsledkov:</label>
                <input placeholder="15" type="number" id="rhyme-number" name="rhyme_number" value="">
                <button id="rhyme-submit-button" type="submit"><img src="../icon/search.svg" alt="Vyhľadávaj"></button>
            </form>
            <article id="rhymes-result">

            </article>
        </div>
    </div>
    <div id="message-box"></div>

</main>


<script src="../js/letterFunctions.js"></script>
    <script src="../libraries/shortcut.js"></script>
<script src="../js/edit.js"></script>
<?php require_once "../php-assets/footer.php"?>