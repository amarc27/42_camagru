<?php ob_start() ?>

<section class='activate-view'>
    <div class="activate-frame">
        <h2>Account activation</h2>
        <p style="font-weight:bold; color: #DA2C38; text-align:center"><?= $error ?></p>
        <p class="connection-btn"><a id="connexion" href="login.php">Log in</a></p>
    </div>
</section>

<?php
    $content = ob_get_clean();
    $title = "Activate account &bull Camagru";
    require('template.php');
?>