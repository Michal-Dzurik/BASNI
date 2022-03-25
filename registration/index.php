<?php require_once "../php-assets/header.php"; ?>

    <main class="background">
        <form id="form" action="registration/register.php" method="POST" class="clearfix">
            <h2>REGISTRÁCIA<span>.</span></h2>
            <div class="block">
                <input type="text" placeholder="Meno" name="name" autofocus spellcheck="false" required>
            </div>
            <div class="block">
                <input type="text" placeholder="Priezvisko" name="last_name" spellcheck="false" required>
            </div>
            <div class="block login">
                <input type="text" placeholder="Login" name="login" spellcheck="false" required>
            </div>
            <div class="block age">
                <input type="number" placeholder="Vek" name="age" spellcheck="false" required>
            </div>
            <div class="block">
                <input type="email" placeholder="Email" name="email" spellcheck="false" required>
            </div>
            <div class="block">
                <input type="password" placeholder="Heslo" name="password" spellcheck="false" required>
            </div>
            <div class="block">
                <input type="password" placeholder="Zopakujte heslo" name="password_repeat" spellcheck="false" required>
            </div>

            <button type="submit">REGISTROVAŤ<span>.</span></button>

        </form>
    </main>
    <div id="message-box">
    </div>

    <script src="../js/registration.js"></script>

    <?php require_once "../php-assets/footer.php"?>