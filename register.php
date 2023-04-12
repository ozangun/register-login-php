<!DOCTYPE html>
<html>
<head>
	<title>Kayıt Ol Sayfası</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">
</head>
<body>
	<div class="form-container">
		<h1>Kayıt Ol</h1>
		<form action="register.php" method="POST">
			<label for="name">Kullanıcı Adı:</label>
			<input type="text" id="name" name="name" placeholder="Kullanıcı adınızı girin" required>

			<label for="email">E-posta Adresi:</label>
			<input type="email" id="email" name="email" placeholder="E-posta adresinizi girin" required>

			<label for="password">Parola:</label>
			<input type="password" id="password" name="password" placeholder="Parolanızı girin" required>

			<label for="password-confirm">Parola Onayı:</label>
			<input type="password" id="password-confirm" name="password-confirm" placeholder="Parolanızı tekrar girin" required>

			<input type="submit" name="submit" value="Kayıt Ol">
		</form>
	</div>
</body>
</html>
<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "site";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


if (!$conn) {
	die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}


if(isset($_POST["submit"])) {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$password_confirm = $_POST["password-confirm"];

	
	if ($password != $password_confirm) {
		echo " 
<script type='text/javascript'>  
alert('Parolalar eşleşmiyor.'); 
</script> 
<head>

<meta http-equiv='refresh' content='0; url=register.html'> 

</head>

";
		exit();
	}
    if (strlen($password) < 8  ) {
		echo " 
<script type='text/javascript'>  
alert('Parolala en az 8 karakter olmalıdır.'); 
</script> 
<head>

<meta http-equiv='refresh' content='0; url=register.html'> 

</head>

";
		exit();
	}

	
	$sql = "SELECT * FROM users WHERE email='$email'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo " 
<script type='text/javascript'>  
alert('Bu eposta adresi zaten kullanımda.'); 
</script> 
<head>

<meta http-equiv='refresh' content='0; url=register.html'> 

</head>

";
		exit();
	}
    $sql = "SELECT * FROM users WHERE name='$name'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo " 
<script type='text/javascript'>  
alert('Bu kullanıcı adı zaten kullanımda'); 
</script> 
<head>

<meta http-equiv='refresh' content='0; url=register.html'> 

</head>

";
		exit();
	}
    if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email) || preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,50}$/', $password)) {
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
	if (mysqli_query($conn, $sql)) {
		echo " 
<script type='text/javascript'>  
alert('Kayıt işlemi başarı ile tamamlandı.'); 
</script> 
<head>

<meta http-equiv='refresh' content='0; url=login.php'> 

</head>

";
    }
        
      } else {
        
        echo " 
<script type='text/javascript'>  
alert('Email adresi uygun biçimde girilmedi.'); 
</script> 
<head>

<meta http-equiv='refresh' content='0; url=register.html'> 

</head>

";
        
      }

	
}