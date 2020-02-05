<?php
    ob_start();
    $srcDIR = "http://".$_SERVER['HTTP_HOST']."/camagru";
?>
<section id="content">
    <div class="log-page">
        <h1>Camagru</h1>
        <h3>Connectez-vous pour voir les photos de vos amis</h3>
        <p style="font-weight:bold; color: #DA2C38"><?= $error ?></p>
        <form class="subscription-form" action="" method="post">
            <input type="text" name="login" placeholder="Nom d'utilisateur" required>
            <input type="password" name="passwd" placeholder="Mot de passe" required>
            <input type="submit" name="submit" value="Se connecter">
        </form>
        <p><a href="forgotten_pass.php">Mot de passe oubli&eacute; ?</a></p>
        <p>Vous n'avez pas de compte ? <a href=<?php echo $srcDIR."/signup.php"?>>Inscrivez-vous</a></p>
    </div>
</section>

<?php
    $content = ob_get_clean();
    $title = "Login &#8226; Camagru";
    require('view/template.php');
?>