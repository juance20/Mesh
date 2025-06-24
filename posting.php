<!DOCTYPE html>
<html lang="es"><head> <link rel="stylesheet" href="style.css">

  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Proyecto blogs</title></head><body style="height: 716px;">
    
    
    <table style="text-align: left; width: 100%; height: 100%;" border="0" cellpadding="2" cellspacing="2">
      <tbody>
        <tr>
          <td style="vertical-align: top; height: 113px; text-align: center; width: 339px;"><br>
          </td>
          <td style="vertical-align: top; height: 113px; text-align: center; width: 917px;">
            <form action="search.php" method="post">
              <input name="search" placeholder="Buscar" type="text">
              <input value="🔎" type="submit">
            </form>
      
            <br>
          </td>
          <td style="vertical-align: middle; height: 113px; text-align: right; width: 336px;">
            <a href="profile.php">
            <?php $session_md5 = $_COOKIE["session"];

              $dbhost = "localhost";
              $dbuser = "juan";
              $dbpass = "root";
              $dbname = "mesh";
              $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);

              $query = "SELECT * FROM users where session_md5=\"$session_md5\"";
              $result = $conn->query($query);
              while($row = $result->fetch_assoc()) {
                $name = $row["username"];
                echo "$name";
              }

            ?>
            <img style="height: 50%;" alt="profile photo" src="profile.jpg"></a><br>
          </td>
        </tr>
        <tr>
          <td style="vertical-align: top; height: 359px; text-align: center; width: 339px;"><br>
          </td>
          <td colspan="1" rowspan="2" style="vertical-align: top; height: 359px; text-align: left; width: 917px;">
              <h1 align="center">Nuevo post</h1>
              <form method="post">
                <br>
                <input type="text" name="title" placeholder="Título" size=50><br><br>
                <textarea name="text" rows=10 cols=100 placeholder="Texto"></textarea><br><br>
                <input type="submit" value="Publicar">
              </form>
              <?php
                if(isset($_POST["title"])){
                    $values = sprintf('"%s", "%s", "%s"', $name, $_POST["title"], $_POST["text"]);
                    $query = "INSERT INTO posts (owner, title, text) values($values)";
                    $result = $conn->query($query);
                    header('Location: profile.php');
                    exit;
                }
                
              ?>

          </td>
          <td style="vertical-align: top; height: 359px; text-align: right; width: 336px;">
            <a href="posting.php">Nuevo post ✎</a>
            <br>
          </td>
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center; width: 339px;"><br>
          </td>
          <td style="vertical-align: top; text-align: center; width: 336px;">
            <br>
          </td>
        </tr>
      </tbody>
    </table>
  </body></html>