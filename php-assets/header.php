<?php
    require_once "../php-assets/config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BÁSNI.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../icon/icon.ico">
    <script src="../libraries/jquery.js"></script>
    <script src="../js/functions.js"></script>
    <script src="../js/main.js"></script>
</head>
<body class="clearfix">
    <nav class="clearfix">
        <ul class="left-navigation">
            <li id="logo">
                <a href="../">BÁSNI<span>.</span></a>
            </li>
            <li>
                <a href="../">Domov</a>
            </li>
            <!---
            <li>
                <a href="../search/">Vyhľadávanie</a>
            </li>
        -->
        </ul>
        <ul class="right-navigation update-navigation">
            <?php if (isset($_SESSION["id"])) : ?>
                <li class="add-button">
                    <a href="../edit/">+</a>
                </li>
                <li class="signed-in">
                    <a href="../sign-out/">Odhlásiť sa</a>
                </li>
                <li class="signed-in">
                    <a href="../profile/index.php?id=<?php echo $_SESSION["id"]?>">Profil</a>
                </li>
            <?php endif;?>
            <?php if (!isset($_SESSION["id"])) : ?>
                <li class="signed-out to-change" id="sign-in">
                    <a href="../login">Prihlásiť</a>
                </li>
                <li class="signed-out to-change" >
                    <a href="../registration">Registrovať</a>
                </li>
            <?php endif;?>
        </ul>
        <ul class="mobile-navigation update-navigation">
            <li>
                <a href="../">Domov</a>
            </li>
            <li>
                <a href="../search/">Vyhľadávanie</a>
            </li>
            <?php if (isset($_SESSION["id"])) : ?>
                <li>
                    <a href="../edit/">Vytvoriť báseň</a>
                </li>
                <li class="signed-in">
                    <a href="../sign-out/">Odhlásiť sa</a>
                </li>
                <li class="signed-in">
                    <a href="../profile/index.php?id=<?php echo $_SESSION["id"]?>">Profil</a>
                </li>
            <?php endif;?>
            <?php if (!isset($_SESSION["id"])) : ?>
                <li class="signed-out to-change" id="sign-in">
                    <a href="../login">Prihlásiť</a>
                </li>
                <li class="signed-out to-change" >
                    <a href="../registration">Registrovať</a>
                </li>
            <?php endif;?>
        </ul>
        <div class="hamburger">
            III
        </div>
    </nav>
