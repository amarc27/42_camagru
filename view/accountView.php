<?php ob_start(); ?>

<section id="content">
    <div class="profile-header">
        <div class="profile-picture">
            <img src=<?= $profile['profile_pic'] ?> alt="Profile picture">
        </div>
        <div class="profile-infos">
            <div class="main">
                <p><?= $profile['login'] ?></p>
                <a href="modify.php">Modify profile</a>
            </div>
        </div>
    </div>
</section>

<?php
    $content = ob_get_clean();
    $title = $profile['login']." &#8226; Camagru";
    require('view/template.php');
?>