<?php
    ob_start();
    $srcDIR = "http://".$_SERVER['HTTP_HOST']."/camagru";
?>

<section id="content">
    <div class="modify-account">
        <div class="modify-form">
            <h3>Edit profile</h3>
            <p style="font-weight:bold; text-align: center; color: #3897f0"><?= $lightModif ?></p>
            <form class="subscription-form" action="" method="post">
                <table>
                    <tr>
                        <td><p>Login</p></td>
                        <td><input type="text" name="login" value="<?= $profile['login']; ?>" required maxlength="12"></td>
                    </tr>
                    <tr>
                            <td><p>Email</p></td>
                            <td><input type="email" name="mail" value="<?= $profile['mail']; ?>" required maxlength="40"></td>
                    </tr>
                    <tr>
                        <td><p>Full name</p></td>
                        <td><input type="text" name="name" value="<?= $profile['name']; ?>" required maxlength="15"></td>
                    </tr>
                    <tr>
                        <td><p>Bio</p></td>
                        <td><textarea type="text" name="bio"><?= $profile['bio']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit-main" value="Save"></td>
                    </tr>
                </table>
            </form>
        </div>
        <br>
        <div class="modify-form password-form">
            <h3>Edit password</h3>
            <p style="font-weight:bold; text-align: center; color: #DA2C38"><?= $error ?></p>
            <form class="subscription-form" action="" method="post">
                <table>
                    <tr>
                        <td><p>Old password</p></td>
                        <td><input type="password" name="oldPasswd" required></td>
                    </tr>
                    <tr>
                        <td><p>New password</p></td>
                        <td><input type="password" name="newPasswd1" required></td>
                    </tr>
                    <tr>
                        <td><p>Confirm new password</p></td>
                        <td><input type="password" name="newPasswd2" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit-new-pass" value="Edit password"></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="modify-form password-form">
            <h3>Delete your account</h3>
            <p style="font-weight:bold; text-align: center; color: #DA2C38"><?= $error ?></p>
            <form class="subscription-form" action="" method="post">
                <table>
                    <tr>
                        <td><p>Write your password</p></td>
                        <td><input type="password" name="passwd" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit-del-user" value="Definitly delete my account"></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="modify-form notifications-mail">
            <h3>Receive notifications by mail ?</h3>
            <p style="font-weight:bold; text-align: center; color: #DA2C38"><?= $error ?></p>
            <form class="subscription-form mail-notif-form" action="" method="POST">
                <div class='notification-choice'>
                    <p>Yes</p>
                    <input type="radio" name="notif" value="1">
                </div>
                <div class='notification-choice'>
                    <p>No</p>
                    <input type="radio" name="notif" value="0">
                </div>
                <input type="submit" name="submit-default-mail" value="Save">
            </form>

    </div>
</section>

<?php
    $content = ob_get_clean();
    $title = "Modify ".$profile['login']." &#8226; Camagru";
    require('view/template.php');
?>