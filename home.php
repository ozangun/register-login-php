 <!DOCTYPE html>
<html>
  <head>
    <title>Web Sayfam</title>
    <link rel="stylesheet" type="text/css" href="indexstyle.css">
    <meta charset="UTF-8">
  </head>
  <body>
  <?php
      session_start();
      if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
      } else {
        header('Location: login.php');
      }
    ?>
    <header>
      <h1>Web Sayfam</h1>
      <nav>
        <ul>
          <li><a href="index.html">Anasayfa</a></li>
          <li><a href="logout.php">Çıkış Yap</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <section>
        <h2>Hoş Geldiniz <?php echo "$name"; ?></h2>
       
      </section>
      <aside>
        
      </aside>
    </main>
    <footer>
      <p>Telif Hakkı &copy; 2023 | Web Sayfam</p>
    </footer>
  </body>
</html>
   
