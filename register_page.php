<?php
    $user = $_POST["user"]; 
    $pass_md5 = md5($_POST["pass"]);
    $email = $_POST["email"];

    $dbhost = "db";
    $dbuser = "juan";
    $dbpass = "root";
    $dbname = "mesh";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
    
    $query = "SELECT * FROM users where username=\"$user\"";
    $result = $conn->query($query);

    $text = "";

    if ($result->num_rows > 0) {
        $text = "Ya existe ese nombre de usuario<br><br><a href=\"registro.html\">Volver</a>";
    }

    else {
        $query = "SELECT * FROM users where email=\"$email\"";
        $result = $conn->query($query);

        if($result->num_rows > 0){
            $text = "El email ya está registrado <br><br><a href=\"index.php\">Iniciar sesión</a>";

        }
        else{

            $cookie_name = "session";
            $time = date("Y-m-d h:i:s", time());
            $cookie_value = md5($user.$time);
            setcookie($cookie_name, $cookie_value, $time + 86400, "/");

            $query = "INSERT INTO users values(\"$user\", \"$email\", \"$pass_md5\",\"$cookie_value\", \"$time\")";
            $result = $conn->query($query);

            header('Location: profile.php');
            exit;
        }
    }

    $conn->close();

?>

<!DOCTYPE html>
<html lang="es">
<head> <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validando</title>
</head>
<body>
    <?php 
        echo $text;
    ?>
</body>
</html>