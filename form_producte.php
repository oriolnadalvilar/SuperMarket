<?php
	require "header.php";
?>
		<div class="container m-5 mx-auto text-white">
			<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-4 offset-2">
						<div class="form-group">
							<label for="codi">Codi:</label>
							<?php if (isset($_POST) && $_POST!=null) { $codi = $_POST["codi"]; 
								echo "<input type=\"text\" class=\"form-control\" name=\"codi\" id=\"codi\" value=\"$codi\" />";
							} elseif (isset($_GET) && $_GET!=null) { $codi = $_GET["codi"]; 
								echo "<input type=\"text\" class=\"form-control\" name=\"codi\" id=\"codi\" value=\"$codi\" />";
							}else {echo "<input type=\"text\" class=\"form-control\" name=\"codi\" id=\"codi\" />";} ?>
							 
						</div>
						<div class="form-group">
							<label for="nom">Nom:</label>
							<?php if (isset($_POST) && $_POST!=null) { $nom = $_POST["nom"]; 
								echo "<input type=\"text\" class=\"form-control\" name=\"nom\" id=\"nom\" value=\"$nom\" />";
							} elseif (isset($_GET) && $_GET!=null) { 
								$codi = $_GET["codi"];
								$sql = "SELECT * FROM productes WHERE codi = '$codi'";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();

								$nom = $row["nom"]; 
								echo "<input type=\"text\" class=\"form-control\" name=\"nom\" id=\"nom\" value=\"$nom\" />";
							} else {echo "<input type=\"text\" class=\"form-control\" name=\"nom\" id=\"nom\" />";} ?>
						</div>
						<div class="form-group">
							<label for="categoria">Categoria:</label>
							<select class="form-control" name="categoria" id="categoria">
							<option value="">Selecciona una opció</option>
							<?php
							include "config.php";
							$sql = "SELECT id_categoria, nom FROM categories ORDER BY nom";
							$result = $conn->query($sql);
							if($result) {
								if ($result->num_rows > 0) {
									$row = $result->fetch_assoc();
									while($row) {
										$idCategoria = $row["id_categoria"];
										$nom = $row["nom"];
										
										if (isset($_POST) && $_POST!=null) {
											echo "<option value=\"$idCategoria\" selected >$nom</option>";
										} elseif (isset($_GET) && $_GET!=null) { 
											$codi = $_GET["codi"];
											$sql = "SELECT * FROM productes WHERE codi = '$codi'";
											$result = $conn->query($sql);
											$row = $result->fetch_assoc();
											
											$idCategoria = $row["categoria"];
											$nom = $row["nom"]; 
											echo "<input type=\"text\" class=\"form-control\" name=\"nom\" id=\"nom\" value=\"$nom\" />";
										} else {echo "<option value=\"$idCategoria\">$nom</option>";}
										

										$row = $result->fetch_assoc();
									}

								} else {
									echo "<p>No hay ningún/a usuario/a</p>";
								}

							}else {
								echo "ERROR al seleccionar los datos";
							}
							
							$conn->close();
							?>	
							</select>
						</div>
						<div class="form-group">
							<label for="preu">Preu:</label>
							<?php if (isset($_POST) && $_POST!=null) { $preu = $_POST["preu"]; 
								echo "<input type=\"number\" class=\"form-control\" name=\"preu\" id=\"preu\" value=\"$preu\" />";
							} else {echo "<input type=\"number\" class=\"form-control\" name=\"preu\" id=\"preu\" />";} ?>
						</div>
						<div class="form-group">
							<label for="stock">Unitats en stock:</label>
							<?php if (isset($_POST) && $_POST!=null) { $stock = $_POST["stock"]; 
								echo "<input type=\"number\" class=\"form-control\" name=\"stock\" id=\"stock\" value=\"$stock\" />";
							} else {echo "<input type=\"number\" class=\"form-control\" name=\"stock\" id=\"stock\" />";} ?>
						</div>
						<div class="form-group text-right">
							<a href="productes.php" class="btn btn-outline-secondary mx-2">Tornar</a>
							<button type="submit" class="btn btn-default">Guardar</button>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="imatge">Imatge:</label>
							<input type="file" class="form-control" name="imatge" id="imatge" />
						</div>
						<div class="text-center">
							<?php if (isset($_POST) && $_POST!=null) { 
								$codi = $_POST["codi"];
								$name = $_FILES["imatge"]["name"];
								$ext = $ext = pathinfo($name, PATHINFO_EXTENSION);
								$upFile = "images/productes/".$codi.".".$ext;
								echo "<img src=\"$upFile\" class=\"img-thumbnail\" style=\"height: 250px;\" />";
							} else {echo "<img src=\"images/productes/no-image.png\" class=\"img-thumbnail\" style=\"height: 250px;\" />";}
							?>
						</div>
					</div>
				</div>
			</form>
			<?php 
			if (isset($_POST) && $_POST!=null) {
				include "config.php";
				$codi = $_POST["codi"];
				$nom = $_POST["nom"];
				$categoria = $_POST["categoria"];
				$preu = $_POST["preu"];
				$stock = $_POST["stock"];
				$name = $_FILES["imatge"]["name"];
				$ext = $ext = pathinfo($name, PATHINFO_EXTENSION);


				$upFile = "images/productes/".$codi.".".$ext;

				if(is_uploaded_file($_FILES["imatge"]["tmp_name"])) {
					if(move_uploaded_file($_FILES["imatge"]["tmp_name"], $upFile)) {
						$sql = "INSERT INTO productes (codi, categoria, nom, preu, unitats_stock, imatge) 
						VALUES ('$codi',$categoria , '$nom', $preu, $stock, '$upFile')";
						$result = $conn->query($sql);

						echo "<div class=\"alert alert-success\" role=\"alert\" >Aliment afegit correctament.</div>";
					}
				} else {
					echo "<div class=\"alert alert-danger\" role=\"alert\" >No ha sigut possible pujar l'arxiu.</div>";
				}

				

			}				
			?>
		</div>
	</body>
</html>
