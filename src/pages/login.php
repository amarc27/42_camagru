<?php
    include_once('auth.php');
    session_start();
    if ($_POST["login"] === "admin" && $_POST["passwd"] === "tonton" && $_POST["submit"] && $_POST["submit"] === "OK")
    {
        echo "<script>window.location.href = './admin.html';</script>";
    }
    else
    {
        if (!($_POST['login'] && $_POST['passwd'] && auth($_POST['login'], $_POST['passwd'])))
        {
            $_SESSION['loggued_on_user'] = "";
            echo "<script type='text/javascript'>alert('Identifiant / mot de passe incorrects');</script>";
            echo "<script>window.location.href = './signin.html';</script>";
        }
        else
        {
            $_SESSION['loggued_on_user'] = $_POST['login'];
            echo "<script>window.location.href = '../index.php';</script>";
            exit();
        }
    }
?>