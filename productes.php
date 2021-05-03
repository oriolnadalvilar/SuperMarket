<?php
	require "header.php";
?>
		<div class="container m-5 mx-auto">
			<div class="col-8 offset-2">
				<table class="table">        
					<tr> 
						<th>Producte</th> 
						<th>Categoria</th>
						<th>Preu</th>
						<th></th>
					</tr>
					<?php 
					include 'config.php';
					$sql = "SELECT * FROM detall_productes";
					$result = $conn->query($sql);
							
					if($result) {
						if ($result->num_rows > 0) {
							$row = $result->fetch_assoc();
							while($row) {

								$imatge = $row["imatge"];
								$nom = $row["nom"];
								$categoria = $row["nom_categoria"];
								$preu = $row["preu"];
								$codi = $row["codi"];

								echo '
								<tr> 
									<td class="align-middle">
										<img src="'.$imatge.'" class="img-thumbnail mr-2" style="height: 50px;" />
										'.$nom.'
									</td>
									<td class="align-middle">'.$categoria.'</td>
									<td class="align-middle">'.$preu.'</td>
									<td class="align-middle">
										<form class="form-inline" action="productes.php" method="post">
											<a href="form_producte.php?codi='.$codi.'" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
											<div class="form-group">
												<input type="hidden" name="codi" value="'.$codi.'" />
											</div>
											<button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"></i></button>
										</form>
									</td> 
								</tr>';
								
								$row = $result->fetch_assoc();
							}

						} else {
							echo "<p>No hay ningún/a usuario/a</p>";
						}

					}else {
						echo "ERROR al seleccionar los datos";
					}
					if (($_POST != NULL || $_POST != "") && $_POST) {
						include 'config.php';

						$codi2 = $_POST["codi"];
						$sql2 = "DELETE FROM productes WHERE codi = '$codi2'";
						$result2 = $conn->query($sql2);
						
						

						if ($result2 == true) {
							echo "<div class=\"alert alert-success\" role=\"alert\" >Aliment eliminat correctament</div>";
						}

					}
					$conn->close();
					?>
				</table>
			</div>
		</div>
	</body>
</html>
