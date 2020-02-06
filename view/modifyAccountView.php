<?php
    ob_start();
    $srcDIR = "http://".$_SERVER['HTTP_HOST']."/camagru";
?>

<section id="content">
    <div class="modify-account">
        <div class="modify-form">
            <h3>Modifier le profil</h3>
            <p style="font-weight:bold; text-align: center; color: #00B200"><?= $lightModif ?></p>
            <form class="subscription-form" action="" method="post">
                <table>
                    <tr>
                        <td><p>Nom d'utilisateur</p></td>
                        <td><input type="text" name="login" value="<?= $profile['login']; ?>" required maxlength="12"></td>
                    </tr>
                    <tr>
                            <td><p>Email</p></td>
                            <td><input type="email" name="mail" value="<?= $profile['mail']; ?>" required maxlength="40"></td>
                    </tr>
                    <tr>
                        <td><p>Nom complet</p></td>
                        <td><input type="text" name="name" value="<?= $profile['name']; ?>" required maxlength="15"></td>
                    </tr>
                    <tr>
                        <td><p>Bio</p></td>
                        <td><textarea type="text" name="bio"><?= $profile['bio']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit-main" value="Sauvegarder"></td>
                    </tr>
                </table>
            </form>
        </div>
        <br>
        <div class="modify-form password-form">
            <h3>Changer de mot de passe</h3>
            <p style="font-weight:bold; text-align: center; color: #DA2C38"><?= $error ?></p>
            <form class="subscription-form" action="" method="post">
                <table>
                    <tr>
                        <td><p>Ancien mot de passe</p></td>
                        <td><input type="password" name="oldPasswd" required></td>
                    </tr>
                    <tr>
                        <td><p>Nouveau mot de passe</p></td>
                        <td><input type="password" name="newPasswd1" required></td>
                    </tr>
                    <tr>
                        <td><p>Confirmer le nouveau mot de passe</p></td>
                        <td><input type="password" name="newPasswd2" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit-new-pass" value="Modifier le mot de passe"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</section>

<?php
    $content = ob_get_clean();
    $title = "Modify ".$profile['login']." &#8226; Camagru";
    require('view/template.php');
?>