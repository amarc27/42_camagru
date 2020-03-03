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
            <input type="text" name="login" placeholder="Username" required maxlength="12">
            <input type="email" name="mail" placeholder="Email" required maxlength="40">
            <input type="text" name="name" placeholder="Full name" required maxlength="15">
            <input type="password" name="passwd" placeholder="Password" required>
            <input type="password" name="passwd2" placeholder="Confirm password" required>
            <input type="submit" name="submit" value="Sign up">
        </form>
        <p>Already have an account ? <a href=<?php echo $srcDIR."/login.php"?>>Log in</a></p>
    </div>
</section>

<?php
    $content = ob_get_clean();
    $title = "Signup &#8226; Camagru";
    require('./view/template.php');
?>