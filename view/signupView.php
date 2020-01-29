<?php
    ob_start();
?>

<section id="content">
    <div class="subscription-page">
        <h1>Camagru</h1>
        <h3>Inscrivez-vous pour voir les photos et vidéos de vos amis.</h3>
        <p style="font-weight:bold; color: #DA2C38"><?= $error ?></p>
        <form class="subscription-form" action="../subscription.php" method="post">
            <input type="text" name="login" placeholder="Nom d'utilisateur">
            <input type="email" name="mail" placeholder="Adresse e-mail">
            <input type="text" name="name" placeholder="Nom complet">
            <input type="password" name="passwd" placeholder="Mot de passe">
            <input type="password" name="passwd2" placeholder="Confirmation de mot de passe">
            <input type="submit" name="submit" value="S'inscrire">
        </form>
    </div>
</section>

<?php
    $content = ob_get_clean();
    require('./template.php');
?>