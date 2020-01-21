<?php
    session_start();
    if ($_POST["login"] && $_POST["passwd"] && $_POST["submit"] && $_POST["submit"] === "OK")
    {
        $content = file_get_contents("../db/users");
        $accounts = unserialize($content);
        $flag = 0;
        if ($accounts !== false)
        {
            foreach ($accounts as $key => $value)
            {
                if ($value["login"] === $_POST["login"])
                    $flag = 1;
            }
        }
        if ($flag)
        {
            echo "<script type='text/javascript'>alert('Cet login est déjà utilisé');</script>";
            echo "<script>window.location.href = './signup.html';</script>";
            exit();
        }
        else
        {
            $user["login"] = $_POST["login"];
            $user["passwd"] = hash("whirlpool", $_POST["passwd"]);
            $accounts[] = $user;
            file_put_contents("../db/users", serialize($accounts));
            header("Location: ../index.php");
            exit();
        }
    }
    else
        echo "ERROR\n";
?>