<?php
    ob_start();
    $srcDIR = "http://".$_SERVER['HTTP_HOST']."/camagru";
?>

<section id="content">
    <div class="log-page">
        <h1>Camagru</h1>
        <h3>Inscrivez-vous pour voir les photos de vos amis</h3>
        <p style="font-weight:bold; color: #DA2C38"><?= $error ?></p>
        <form class="subscription-form" action="" method="post">
            <input type="text" name="login" placeholder="Nom d'utilisateur" required maxlength="12">
            <input type="email" name="mail" placeholder="Adresse e-mail" required maxlength="40">
            <input type="text" name="name" placeholder="Nom complet" required maxlength="15">
            <input type="password" name="passwd" placeholder="Mot de passe" required>
            <input type="password" name="passwd2" placeholder="Confirmation de mot de passe" required>
            <input type="submit" name="submit" value="S'inscrire">
        </form>
        <p>Vous avez déjà un compte ? <a href=<?php echo $srcDIR."/login.php"?>>Connectez-vous</a></p>
    </div>
</section>

<?php
    $content = ob_get_clean();
    $title = "Signup &#8226; Camagru";
    require('./view/template.php');
?>