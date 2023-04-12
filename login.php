<!DOCTYPE html>
<html>
  <head>
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
  </head>
  <body>
    <h1>Giriş Yap</h1>
    <?php
      session_start();
      $message = '';
      if (isset($_POST['name']) && isset($_POST['password'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $db = mysqli_connect('localhost', 'root', '', 'site');
        $query = "SELECT * FROM users WHERE name='$name' AND password='$password'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
          $_SESSION['name'] = $name;
          header('Location: home.php');
        } else {
          $message = 'Kullanıcı adı veya şifre hatalı';
        }
      }
    ?>
    <form method="post" action="">
      <label for="name">Kullanıcı Adı:</label>
      <input type="text" id="name" name="name"><br><br>
      <label for="password">Şifre:</label>
      <input type="password" id="password" name="password"><br><br>
      <input type="submit" value="Giriş">
    </form>
    <p><?php echo $message; ?></p>
  </body>
</html>