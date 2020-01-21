<?php
    session_start();
    if ($_SESSION["loggued_on_user"] !== "")
    {
        $content = file_get_contents("../db/users");
        $account = unserialize($content);
        if ($account)
        {
            $flag = 0;
            foreach ($account as $key => $val)
            {

                if ($val["login"] == $_SESSION["loggued_on_user"])
                {
                    $flag = 1;
                    unset($account[$key]);
                }
            }
            if ($flag)
            {
                file_put_contents("../db/users", serialize($account));
                echo "<script type='text/javascript'>alert('User successfully deleted');</script>";
                echo "<script>window.location.href = './logout.php';</script>";
                exit();
            }
            else
            {
                echo "<script type='text/javascript'>alert('Identifiant incorrect 1');</script>";
                echo "<script>window.location.href = '../index.php';</script>";
                exit();
            }
        }
        else
        {
            echo "<script type='text/javascript'>alert('Identifiant incorrect 2');</script>";
            echo "<script>window.location.href = '../index.php';</script>";
            exit();
        }
    }
    else
    {
        echo "<script type='text/javascript'>alert('Identifiant incorrect 3');</script>";
        echo "<script>window.location.href = '../index.php';</script>";
        exit();
    }
?>