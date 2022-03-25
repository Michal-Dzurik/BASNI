<?php require_once "../php-assets/header.php"; ?>

    <main class="background">
        <form id="form" action="login/login.php" method="POST" class="clearfix">
            <h2>PRIHLÁSENIE<span>.</span></h2>
            <div class="block">
                <input type="email" placeholder="Email" name="email" autofocus spellcheck="false">
            </div>
            <div class="block">
                <input type="password" placeholder="Heslo" name="password" spellcheck="false">
            </div>
            <div class="remember">
                <label>
                    <input type="checkbox">
                    <span class="check"><span></span></span>
                    <span class="label">Zapamätať si údaje</span>
                </label>
            </div>

            <button type="submit">PRIHLÁSIŤ<span>.</span></button>

        </form>
        <div id="message-box"></div>
    </main>

    <script src="../js/login.js"></script>

    <?php require_once "../php-assets/footer.php"?>