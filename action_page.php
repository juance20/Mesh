<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validadndo</title>
</head>
<body>
    <?php
    $user = $_POST["user"]; 
    $pass_md5 = md5($_POST["pass"]);
    
    $dbhost = "localhost";
    $dbuser = "juan";
    $dbpass = "root";
    $dbname = "blog_site";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
    
    $query = "SELECT * FROM users where username=\"$user\" and password_hash=\"$pass_md5\"";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo "goooood";
    }

    else {
        echo "0 results";
    }

    $conn->close();

    ?>
</body>
</html>