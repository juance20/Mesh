<?php
    if(isset($_COOKIE["session"])){
        setcookie("session", "", time() - 3600, "/");
        header("Location: index.php");
        exit;
    }
?>