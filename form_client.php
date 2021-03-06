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
							<?php if (isset($_SESSION["user"]) && $_SESSION["user"]!=null) { 
								include "config.php";
								$user_id = $_SESSION["user"];
								$sql = "SELECT * FROM clients WHERE id_client = $user_id";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();

								$nom_usuari = $row["nom_usuari"]; 
								echo "<input required type=\"text\" class=\"form-control\" name=\"username\" id=\"username\" value=\"$nom_usuari\"/>";
							} else {echo "<input required type=\"text\" class=\"form-control\" name=\"username\" id=\"username\" />";} ?>
							
						</div>
						<div class="form-group">
							<label for="pass">Contrasenya (obligatori):</label>
							<?php if (isset($_SESSION["user"]) && $_SESSION["user"]!=null) { 
								include "config.php";
								$user_id = $_SESSION["user"];
								$sql = "SELECT * FROM clients WHERE id_client = $user_id";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();
								
								$pass = $row["contrasenya"]; 
								echo "<input required type=\"password\" class=\"form-control\" name=\"pass\" id=\"pass\" value=\"$pass\"/>";
							} else {echo "<input required type=\"password\" class=\"form-control\" name=\"pass\" id=\"pass\" />";} ?>
						</div>
						<div class="form-group">
							<label for="rp_pass">Repeteix la contrasenya (obligatori):</label>
							<?php if (isset($_SESSION["user"]) && $_SESSION["user"]!=null) { 
								include "config.php";
								$user_id = $_SESSION["user"];
								$sql = "SELECT * FROM clients WHERE id_client = $user_id";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();
								
								$pass = $row["contrasenya"]; 
								echo "<input required type=\"password\" class=\"form-control\" name=\"rp_pass\" id=\"rp_pass\" value=\"$pass\"/>";
							} else {echo "<input required type=\"password\" class=\"form-control\" name=\"rp_pass\" id=\"rp_pass\" />";} ?>
						</div>
						<div class="form-group">
							<label for="nombre">Nom (obligatori):</label>
							<?php if (isset($_SESSION["user"]) && $_SESSION["user"]!=null) { 
								include "config.php";
								$user_id = $_SESSION["user"];
								$sql = "SELECT * FROM clients WHERE id_client = $user_id";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();
								
								$nom = $row["nom"]; 
								echo "<input required type=\"text\" class=\"form-control\" name=\"nombre\" id=\"nombre\" value=\"$nom\"/>";
							} else {echo "<input required type=\"text\" class=\"form-control\" name=\"nombre\" id=\"nombre\" />";} ?>
						</div>
						<div class="form-group">
							<label for="apellidos">Cognoms (obligatori):</label>
							<?php if (isset($_SESSION["user"]) && $_SESSION["user"]!=null) { 
								include "config.php";
								$user_id = $_SESSION["user"];
								$sql = "SELECT * FROM clients WHERE id_client = $user_id";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();
								
								$cognoms = $row["cognoms"]; 
								echo "<input required type=\"text\" class=\"form-control\" name=\"apellidos\" id=\"apellidos\" value=\"$cognoms\"/>";
							} else {echo "<input required type=\"text\" class=\"form-control\" name=\"apellidos\" id=\"apellidos\" />";} ?>
						</div>
						<div class="form-group">
							<label for="nif">NIF (obligatori):</label>
							<?php if (isset($_SESSION["user"]) && $_SESSION["user"]!=null) { 
								include "config.php";
								$user_id = $_SESSION["user"];
								$sql = "SELECT * FROM clients WHERE id_client = $user_id";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();
								
								$nif = $row["nif"]; 
								echo "<input required type=\"text\" class=\"form-control\" name=\"nif\" id=\"nif\" value=\"$nif\"/>";
							} else {echo "<input required type=\"text\" class=\"form-control\" name=\"nif\" id=\"nif\" />";} ?>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="direccion">Adre??a (obligatori):</label>
							<?php if (isset($_SESSION["user"]) && $_SESSION["user"]!=null) { 
								include "config.php";
								$user_id = $_SESSION["user"];
								$sql = "SELECT * FROM clients WHERE id_client = $user_id";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();
								
								$adreca = $row["adreca"]; 
								echo "<input required type=\"text\" class=\"form-control\" name=\"direccion\" id=\"direccion\" value=\"$adreca\"/>";
							} else {echo "<input required type=\"text\" class=\"form-control\" name=\"direccion\" id=\"direccion\" />";} ?>
						</div>
						<div class="form-group">
							<label for="codigo_postal">Codi postal (obligatori):</label>
							<?php if (isset($_SESSION["user"]) && $_SESSION["user"]!=null) { 
								include "config.php";
								$user_id = $_SESSION["user"];
								$sql = "SELECT * FROM clients WHERE id_client = $user_id";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();
								
								$codi_postal = $row["codi_postal"]; 
								echo "<input required type=\"text\" class=\"form-control\" name=\"codigo_postal\" id=\"codigo_postal\" value=\"$codi_postal\"/>";
							} else {echo "<input required type=\"text\" class=\"form-control\" name=\"codigo_postal\" id=\"codigo_postal\" />";} ?>
						</div>
						<div class="form-group">
							<label for="poblacion">Poblaci?? (obligatori):</label>
							<select required class="form-control" name="poblacion" id="poblacion">
								<option value="">Selecciona una opci??</option>
								<?php
									include 'config.php';
									$sql = "SELECT id_poblacio, nom FROM poblacions ORDER BY nom";
									$result = $conn->query($sql);

									if ($result) {
										if ($result->num_rows > 0) {
											$pobSelected = false;
											$row = $result->fetch_assoc();
											while($row) {
												$nom = $row["nom"];
												$poblacio = $row["id_poblacio"];

												if (isset($_SESSION["user"]) && $_SESSION["user"]!=null && $pobSelected==false) { 
													include "config.php";
													$user_id = $_SESSION["user"];
													$sql2 = "SELECT * FROM clients WHERE id_client = $user_id";
													$result2 = $conn->query($sql2);
													$row2 = $result2->fetch_assoc();
													
													$id_poblacio = $row2["poblacio"]; 
													$sql2 = "SELECT * FROM poblacions WHERE id_poblacio = $id_poblacio";
													$result2 = $conn->query($sql2);
													$row2 = $result2->fetch_assoc();
													$poblacio2 = $row2["id_poblacio"]; 
													$nom2 = $row2["nom"];
													echo "echo \"<option value=\"$poblacio2\" selected>$nom2</option>\";";
													$pobSelected = true;
												} else {echo "<option value=\"$poblacio\">$nom</option>";}

												

												$row = $result->fetch_assoc();
											}

											echo "</table>";

											} else {
												echo "<p>No hay ning??n/a usuario/a</p>";
											}

										} else {
											echo "ERROR al seleccionar los datos";
										}
									mysqli_close($conn);
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="telefono">Tel??fon:</label>
							<?php if (isset($_SESSION["user"]) && $_SESSION["user"]!=null) { 
								include "config.php";
								$user_id = $_SESSION["user"];
								$sql = "SELECT * FROM clients WHERE id_client = $user_id";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();
								
								$telefon = $row["telefon"]; 
								echo "<input type=\"text\" class=\"form-control\" name=\"telefono\" id=\"telefono\" value=\"$telefon\"/>";
							} else {echo "<input type=\"text\" class=\"form-control\" name=\"telefono\" id=\"telefono\" />";} ?>
						</div>
						<div class="form-group">
							<label for="codigo_postal">Email:</label>
							<?php if (isset($_SESSION["user"]) && $_SESSION["user"]!=null) { 
								include "config.php";
								$user_id = $_SESSION["user"];
								$sql = "SELECT * FROM clients WHERE id_client = $user_id";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();
								
								$email = $row["email"]; 
								echo "<input type=\"text\" class=\"form-control\" name=\"mail\" id=\"mail\" value=\"$email\"/>";
							} else {echo "<input type=\"text\" class=\"form-control\" name=\"mail\" id=\"mail\" />";} ?>
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
				$session = false;

				if (isset($_SESSION["user"])) {
					$user_id = $_SESSION["user"];
					$sql = "UPDATE clients 
					SET nom_usuari = '$username', contrasenya = '$pass', nom = '$nombre', 
					cognoms = '$apellidos', nif = '$nif', adreca = '$adreca', codi_postal = '$codigo_postal', 
					poblacio = $poblacion, telefon = '$telefono', email = '$mail' 
					WHERE id_client = $user_id";
					$session = true;
				} else {
					$sql = "INSERT INTO clients (nom_usuari, contrasenya, nom, cognoms, nif, adreca, codi_postal, poblacio, telefon, email) VALUES ('$username', '$pass', '$nombre', '$apellidos', '$nif', '$adreca', '$codigo_postal', $poblacion, '$telefono', '$mail')";
				}
				

				//echo $sql;

				$result = $conn->query($sql);
				$valid = false;

				if ($valid == false && $session == false) {
					$offset = 0;
					$uppercase = preg_match('@[A-Z]@', $pass);
					$lowercase = preg_match('@[a-z]@', $pass);
					$number = preg_match('@[0-9]@', $pass);
					if (strlen($username) < 6) { echo "<div class=\"alertdiv\">El nom d'usuari no ??s v??lid.</div>
						"; }
					elseif ($pass != $rp_pass) { echo "<div class=\"alertdiv\">Les contrasenyes no coincideixen.</div>"; }
					elseif (!$uppercase || !$lowercase || !$number || !strlen($pass) > 8) {
						echo "<div class=\"alertdiv\">La contrasenya no es prou segura. Ha de incloure min??scules, maj??sucules, nombres i una llargada superior o igual a 8.</div>";
					}
					elseif (strlen($nif) != 9 || strpos( $nif , $uppercase , $offset == -9 )) { echo "<div class=\"alertdiv\">El NIF no es v??lid.</div>"; }
					elseif (!preg_match("/^[a-z][_a-z0-9-]+(\.[_a-z0-9-]+)*@([a-z0-9-]{2,})+(\.[a-z0-9-]{2,})*$/", $mail)) {
						echo "<div class=\"alertdiv\">El correu no ??s v??lid.</div>";
					} else {$valid = true;}
				}
				

				if ($valid == true) {echo '<script type="text/javascript">window.location = "entrar.php"</script>';}
				elseif($session == true && $result) {echo "<div class=\"alert alert-success\" role=\"alert\" >Dades modificades correctament.</div>";} 

			}
			$conn->close();
		?>
	</body>
</html>
