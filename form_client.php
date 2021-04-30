<?php
	require "header.php";
?>
<head><link rel="stylesheet" type="text/css" href="./css/styles.css"></head>

		<div class="container m-5 mx-auto text-white">
			<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
				<div class="row">
					<div class="col-4 offset-2">
						<div class="form-group">
							<label for="username">Nom d'usuari (obligatori):</label>
							<input required type="text" class="form-control" name="username" id="username" />
						</div>
						<div class="form-group">
							<label for="pass">Contrasenya (obligatori):</label>
							<input required type="password" class="form-control" name="pass" id="pass" />
						</div>
						<div class="form-group">
							<label for="rp_pass">Repeteix la contrasenya (obligatori):</label>
							<input required type="password" class="form-control" name="rp_pass" id="rp_pass" />
						</div>
						<div class="form-group">
							<label for="nombre">Nom (obligatori):</label>
							<input required type="text" class="form-control" name="nombre" id="nombre" />
						</div>
						<div class="form-group">
							<label for="apellidos">Cognoms (obligatori):</label>
							<input required type="text" class="form-control" name="apellidos" id="apellidos" />
						</div>
						<div class="form-group">
							<label for="nif">NIF (obligatori):</label>
							<input required type="text" class="form-control" name="nif" id="nif" />
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="direccion">Adreça (obligatori):</label>
							<input required type="text" class="form-control" name="direccion" id="direccion" />
						</div>
						<div class="form-group">
							<label for="codigo_postal">Codi postal (obligatori):</label>
							<input required type="text" class="form-control" name="codigo_postal" id="codigo_postal" />
						</div>
						<div class="form-group">
							<label for="poblacion">Població (obligatori):</label>
							<select required class="form-control" name="poblacion" id="poblacion">
								<option value="">Selecciona una opció</option>
								<?php
									include 'config.php';
									$sql = "SELECT id_poblacio, nom FROM poblacions ORDER BY nom";
									$result = $conn->query($sql);

									if ($result) {
										if ($result->num_rows > 0) {
											$row = $result->fetch_assoc();
											while($row) {
												$nom = $row["nom"];
												$poblacio = $row["id_poblacio"];

												echo "<option value=\"$poblacio\">$nom</option>";

												$row = $result->fetch_assoc();
											}

											echo "</table>";

											} else {
												echo "<p>No hay ningún/a usuario/a</p>";
											}

										} else {
											echo "ERROR al seleccionar los datos";
										}
									mysqli_close($conn);
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="telefono">Telèfon:</label>
							<input type="text" class="form-control" name="telefono" id="telefono" />
						</div>
						<div class="form-group">
							<label for="codigo_postal">Email:</label>
							<input type="text" class="form-control" name="mail" id="mail" />
						</div>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-default">Enviar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<?php  
			include 'config.php';
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			if (!empty($_POST)) {
				$username = $_POST["username"];
				$pass = $_POST["pass"];
				$rp_pass = $_POST["rp_pass"];
				$nombre = $_POST["nombre"];
				$apellidos = $_POST["apellidos"];
				$nif = $_POST["nif"];
				$adreca = $_POST["direccion"];
				$codigo_postal = $_POST["codigo_postal"];
				$poblacion = $_POST["poblacion"];
				$telefono = $_POST["telefono"];
				$mail = $_POST["mail"];

				$sql = "INSERT INTO clients (nom_usuari, contrasenya, nom, cognoms, nif, adreca, codi_postal, poblacio, telefon, email) VALUES ('$username', '$pass', '$nombre', '$apellidos', '$nif', '$adreca', '$codigo_postal', $poblacion, '$telefono', '$mail')";

				//echo $sql;

				$result = $conn->query($sql);
				$valid = false;

				if ($valid == false) {
					$uppercase = preg_match('@[A-Z]@', $pass);
					$lowercase = preg_match('@[a-z]@', $pass);
					$number = preg_match('@[0-9]@', $pass);
					if (strlen($username) < 6) { echo "<div class=\"alertdiv\">El nom d'usuari no és vàlid.</div>
						"; }
					elseif ($pass != $rp_pass) { echo "<div class=\"alertdiv\">Les contrasenyes no coincideixen.</div>"; }
					elseif (!$uppercase || !$lowercase || !$number || !strlen($pass) > 8) {
						echo "<div class=\"alertdiv\">La contrasenya no es prou segura. Ha de incloure minúscules, majúsucules, nombres i una llargada superior o igual a 8.</div>";
					}
					elseif (strlen($nif) != 9 || strpos( $nif , $uppercase , $offset == -9 )) { echo "<div class=\"alertdiv\">El NIF no es vàlid.</div>"; }
					elseif (!preg_match("/^[a-z][_a-z0-9-]+(\.[_a-z0-9-]+)*@([a-z0-9-]{2,})+(\.[a-z0-9-]{2,})*$/", $mail)) {
						echo "<div class=\"alertdiv\">El correu no és vàlid.</div>";
					} else {$valid = true;}
				}
				

				if ($valid == true) {echo '<script type="text/javascript">window.location = "entrar.php"</script>';} 

			}
			$conn->close();
		?>
	</body>
</html>
