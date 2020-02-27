<?php ob_start(); ?>

<section id="content">
    <p style="font-weight:bold; color: #DA2C38; text-align: center"><?= $error ?></p>
    <?php
        if (isset($img_src) && isset($nb_like))
        {
    ?>
        <img id="comment-page-picture" src="<?=$img_src?>" alt="assembly_photo">
        <div class="picture_infos">
            <p>Likes: <?=$nb_like?></p>
            <?php
                while($data = $comments->fetch())
                {
                    $profile = get_profile_from_id($data['id_user']);
                    if ($profile['login'] === $_SESSION['login']) {
                        echo("
                            <div class='comment'>
                                <form class='delete-comment-form' action='' method='post'>
                                <input type='hidden' name='id_com' value='".$data['id_com']."'>
                                <input id='delete-comment-btn' type='submit' name='delete-comment' value='&#215;'>
                                </form>
                                <p><strong>".$profile['login']."</strong> &nbsp;".$data['text']."</p>
                            </div>");
                    }
                    else
                    {
                        echo("
                            <div class='comment'>
                                <p><strong>".$profile['login']."</strong> &nbsp;".$data['text']."</p>
                            </div>");
                    }
                }
            ?>
            <form class="subscription-form comment-form" action="" method="post">
                <textarea name="comment" id="areaInput" class="comment-area" placeholder="Write a comment" required autofocus ></textarea>
                <input id="triggerBtn" type="submit" name="submit-comment" value="Add comment">
            </form>
        </div>
    <?php 
        }
    ?>
    <script>
        var input = document.getElementById("areaInput");
        input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("triggerBtn").click();
            }
        });
    </script>
</section>

<?php
    $content = ob_get_clean();
    $title = "Comment photo &#8226; Camagru";
    require('view/template.php');
?>