<?php
    ob_start();
    $srcDIR = "http://".$_SERVER['HTTP_HOST']."/camagru";
    $login_link = $srcDIR."/login.php";
?>

<section id="content">
    <div class="modify-account">
        <div class="modify-form password-form">
            <h3>Reset password</h3>
            <p style="font-weight:bold; text-align: center; color: #DA2C38"><?= $error ?></p>
            <?php
            if ($error == 'Link not valid aymore. Please repeat operation')
                echo "<a href=\"$login_link\" style=\"text-align: center; color: #3897f0;\">Click here to retry</a>";
            ?>
            <form class="subscription-form" action="" method="post">
                <table>
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
                        <td><input type="submit" name="submit-new-pass" value="Reset password"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</section>

<?php
    $content = ob_get_clean();
    $title = "Reset password &#8226; Camagru";
    require('view/template.php');
?>