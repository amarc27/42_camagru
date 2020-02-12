<?php
    ob_start();
    $srcDIR = "http://".$_SERVER['HTTP_HOST']."/camagru";
?>
<section id="content">
    <div class="log-page">
        <h1>Camagru</h1>
        <h3>Sign up to see photos and videos from your friends</h3>
        <p style="font-weight:bold; color: #DA2C38"><?= $error ?></p>
        <form class="subscription-form" action="" method="post">
            <input type="text" name="login" placeholder="Nom d'utilisateur" required maxlength="12">
            <input type="password" name="passwd" placeholder="Mot de passe" required>
            <input type="submit" name="submit" value="Se connecter">
        </form>
        <p><a href=<?php echo $srcDIR."/forgotPasswd.php" ?>>Forgot password ?</a></p>
        <p>You don't have an account ? <a href=<?php echo $srcDIR."/signup.php"?>>Sign up</a></p>
    </div>
</section>

<?php
    $content = ob_get_clean();
    $title = "Login &#8226; Camagru";
    require('view/template.php');
?>