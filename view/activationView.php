<?php ob_start() ?>

<section>
    <div class="activate-frame">
        <h2>Activation de votre compte</h2>
        <p style="font-weight:bold; color: #DA2C38; text-align:center"><?= $error ?></p>
        <p class="connection-btn"><a id="connexion" href="login.php">Connectez-vous</a></p>
    </div>
</section>

<?php
    $content = ob_get_clean();
    $title = "Activate account &bull Camagru";
    require('template.php');
?>