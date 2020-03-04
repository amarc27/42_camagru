<?php ob_start(); ?>

<section id="content">
    <div class="account-gallery">
        <div class="profile-header">
            <div class="profile-picture">
                <p id='colored-pp'><?=$profile['login'][0];?></p>
            </div>
            <div class="profile-infos">
                <div class="main">
                    <p><?= $profile['login'] ?></p>
                    <a href="modifyAccount.php">Modify profile</a>
                </div>
                <div class="profile-stats">
                    <p><strong><?= $nb_photos ?></strong> photos</p>
                </div>
                <div class="profile-bio">
                    <p class="profile-name"><?= $profile['name'] ?></p>
                    <p class="profile-bio"><?= $profile['bio'] ?></p>
                </div>
            </div>
        </div>
        <div id="correct-gallery" class='account-view'>
            <p style="font-weight:bold; color: #DA2C38; text-align: center"><?= $error ?></p>
            <article id="gallery">
                <?php
                    while($pic = $my_pics->fetch()) {
                        echo "<div class='image-area'>";
                            echo "<a href='comment.php?action=comment&id=".$pic['id_img']."'><img src='".$pic['img']."' alt=''></a>";
                        echo "</div>";
                    }
                ?>
            </article>
            <div id="pagination">
                <?php
                    if ($page > 1)
                        echo "<a id='previous-link' href='?page=".($page - 1)."'>Previous</a>";
                    if ($page < $my_page_number)
                        echo "<a id='next-link' href='?page=".($page + 1)."'>Next</a>";
                ?>
            </div>
        </div>
    </div>
</section>
<script src="public/js/colors.js"></script>

<?php
    $content = ob_get_clean();
    $title = $profile['login']." &#8226; Camagru";
    require('view/template.php');
?>