<?php ob_start(); ?>

<section id="content">
    <div class="modify-account">
        <div class="modify-form password-form">
            <h3>Forgot password</h3>
            <p style="font-weight:bold; text-align: center; color: #DA2C38"><?= $error ?></p>
            <form class="subscription-form" action="" method="post">
                <table>
                    <tr>
                        <td><p>Write your email</p></td>
                        <td><input type="email" name="mail" placeholder="Adresse e-mail" required maxlength="40"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit-reset-passwd" value="Reset password"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</section>

<?php
    $content = ob_get_clean();
    $title = "Password forgotten &#8226; Camagru";
    require('view/template.php');
?>