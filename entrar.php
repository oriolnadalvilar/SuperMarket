<?php
	require "header.php";
?>
<head><link rel="stylesheet" type="text/css" href="./css/styles.css"></head>
		<div class="container m-5 mx-auto col-4 offset-4 text-white">
			<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
				<div class="form-group">
					<label for="username">Nom d'usuari:</label>
					<input type="text" class="form-control" name="username" id="username" />
				</div>
				<div class="form-group">
					<label for="pass">Contrasenya:</label>
					<input type="password" class="form-control" name="pass" id="pass" />
				</div>
				<div class="form-group text-right">
					<button type="submit" class="btn btn-default">Entrar</button>
				</div>
			</form>
			<?php 
				session_start();

				$incioSesion = false;
				$error = false;
			
				if (!empty($_POST)) {
			
					include 'config.php';
					$conn = new mysqli($servername, $username, $password, $dbname);
					
					if ($conn->connect_error) {
						die("ERROR al conectar con la BBDD");
					}
			
					$usuario = $_POST["username"];
					$contrasenya = $_POST["pass"];
			
					$sql = "SELECT * FROM clients
							WHERE nom_usuari = '$usuario' AND contrasenya = '$contrasenya'";
					
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();

					if ($row) {	
						
						$_SESSION["user"] = $row["id_usuari"];
			
						$incioSesion = true;
			
					} else {$error = true;}
			
					$conn->close();
				}
			
				if ($incioSesion) {
					header("Location: comprar.php");
				} elseif ($error == true) {
					echo "<div class=\"alertdiv\">Les dades no són vàlides.</div>";
				}
			?>
		</div>
	</body>
</html>
