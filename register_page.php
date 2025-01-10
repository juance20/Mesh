<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validando</title>
</head>
<body>
    <?php
    $user = $_POST["user"]; 
    $pass_md5 = md5($_POST["pass"]);
    $email = $_POST["email"];

    $dbhost = "localhost";
    $dbuser = "juan";
    $dbpass = "root";
    $dbname = "blog_site";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
    
    $query = "SELECT * FROM users where username=\"$user\"";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "Ya existe ese nombre de usuario<br><br>";
        echo "<a href=\"registro.html\">Volver</a>";
    }

    else {
        $query = "SELECT * FROM users where email=\"$email\"";
        $result = $conn->query($query);

        if($result->num_rows > 0){
            echo "El email ya está registrado <br><br>";
            echo "<a href=\"index.html\">Iniciar sesión</a>";

        }
        else{
            
            $query = "INSERT INTO users values(\"$user\", \"$email\", \"$pass_md5\")";
            $result = $conn->query($query);

            echo "Registrado exitosamente!";
        }
    }

    $conn->close();

    ?>
</body>
</html>