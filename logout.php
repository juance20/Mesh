<?php
        if(isset($_COOKIE["session"])){
            setcookie("session", "", $time = date("Y-m-d h:i:s", time()) - 3600, "/");
            header("Location: index.php");
            exit;
        }
?>