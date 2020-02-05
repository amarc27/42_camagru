<?php
    ob_start();
    $srcDIR = "http://".$_SERVER['HTTP_HOST']."/camagru";
    $error = "";
?>

<section id="content">
    <div class="modify-account">
        <div class="modify-form">
            <h3>Modifier vos informations</h3>
            <p style="font-weight:bold; color: #DA2C38"><?= $error ?></p>
            <form class="subscription-form" action="" method="post">
                <table>
                    <tr>
                        <td><p>Nom d'utilisateur</p></td>
                        <td><input type="text" name="login" value=<?= $profile['login']; ?> required maxlength="12"></td>
                    </tr>
                    <tr>
                            <td><p>Email</p></td>
                            <td><input type="email" name="mail" value=<?= $profile['mail']; ?> required maxlength="40"></td>
                    </tr>
                    <tr>
                        <td><p>Nom complet</p></td>
                        <td><input type="text" name="name" value=<?= $profile['name']; ?> required maxlength="15"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit" value="Sauvegarder"></td>
                    </tr>
                </table>
            </form>
        </div>
        <br>
        <div class="modify-form">
            <h3>Modifier vos informations</h3>
            <p style="font-weight:bold; color: #DA2C38"><?= $error ?></p>
            <form class="subscription-form" action="" method="post">
                <table>
                    <tr>
                        <td><p>Nom d'utilisateur</p></td>
                        <td><input type="text" name="login" value=<?= $profile['login']; ?> required maxlength="12"></td>
                    </tr>
                    <tr>
                            <td><p>Email</p></td>
                            <td><input type="email" name="mail" value=<?= $profile['mail']; ?> required maxlength="40"></td>
                    </tr>
                    <tr>
                        <td><p>Nom complet</p></td>
                        <td><input type="text" name="name" value=<?= $profile['name']; ?> required maxlength="15"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit" value="Sauvegarder"></td>
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