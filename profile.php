<!DOCTYPE html>
<html lang="es"><head>

  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Mi perfil</title></head><body style="height: 716px;">
    
    
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
            <?php $session_md5 = $_COOKIE["session"];

              $dbhost = "localhost";
              $dbuser = "juan";
              $dbpass = "root";
              $dbname = "mesh";
              $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);

              $query = "SELECT * FROM users where session_md5=\"$session_md5\"";
              $result = $conn->query($query);
              if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                  $name = $row["username"];
                  echo "$name";
                }
              }

            ?>
            <img style="height: 50%;" alt="profile photo" src="profile.jpg"><br>
          </td>
        </tr>
        <tr>
          <td style="vertical-align: top; height: 359px; text-align: center; width: 339px;"><br>
          </td>
          <td colspan="1" rowspan="2" style="vertical-align: top; height: 359px; text-align: left; width: 917px;">

            <h1 align="center">Mi perfil</h1>

            <?php $query = "SELECT * FROM posts where owner=\"$name\" order by fecha desc";
              $result = $conn->query($query);
              while($row = $result->fetch_assoc()) {
                $title = $row["title"];
                $text = $row["text"];
                $fecha = $row["fecha"];
                $likes = $row["likes"];
                $comments = $row["comments_cant"];
                $edited = $row["edited"];
                $id = $row["id"];
                if($edited != 0){
                  echo "<hr><a href=\"full_post.php?post_id=$id\"><h3>$title (Editado)</h3></a><p>$fecha</p>$text<br>$likes 👍 $comments 💬 ";
                }
                else{
                  echo "<hr><a href=\"full_post.php?post_id=$id\"><h3>$title</h3></a><p>$fecha</p>$text<br>$likes 👍 $comments 💬 ";
                }
                echo "<a href=\"edit.php?id=$id\">Editar ✎</a>";
              }
            ?>
          </td>
          <td style="vertical-align: top; height: 359px; text-align: right; width: 336px;">
            <a href="posting.php">Nuevo post ✎</a>
            <br><br>
            <a href="logout.php">Cerrar sesión</a>
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