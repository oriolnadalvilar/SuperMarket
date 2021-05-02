<?php
	require "header.php";
	include "common/carrito.php";
	if (!empty($_POST)) {
		$codi_producte = $_POST["codi"];
		$quantitat = $_POST["quantitat"];

		include "config.php";
		$sql = "SELECT nom,preu FROM productes WHERE codi = '$codi_producte'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		$nom = $row["nom"];
		$preu = $row["preu"];

		$afegit = afegirProducte($codi_producte, $nom, $preu, $quantitat);
	}
	
?>
		<div class="container m-5 mx-auto">
			<div class="col-8 offset-2">
				<h3 class="text-white">Contingut del carrito</h3>
				<table class="table">        
					<tr> 
						<th>Producte</th> 
						<th class="text-right">Preu</th>
						<th class="text-right">Unitats</th>
						<th class="text-right">Import</th>
					</tr>
					<?php 
						if (!empty($_SESSION["carrito"])) {
							
						}
					?>
					<tr> 
						<td class="align-middle">
							Arroz Golden Sun 1 kg
						</td>
						<td class="align-middle text-right">0.75 €</td>
						<td class="align-middle text-right">2 u.</td>
						<td class="align-middle text-right">1.50 €</td>
					</tr>
					<tr> 
						<td class="align-middle">
							Arroz Golden Sun 1 kg
						</td>
						<td class="align-middle text-right">0.75 €</td>
						<td class="align-middle text-right">2 u.</td>
						<td class="align-middle text-right">1.50 €</td>
					</tr>
					<tr> 
						<td class="align-middle">
							Arroz Golden Sun 1 kg
						</td>
						<td class="align-middle text-right">0.75 €</td>
						<td class="align-middle text-right">2 u.</td>
						<td class="align-middle text-right">1.50 €</td>
					</tr>
					<tr> 
						<td class="align-middle">
							Arroz Golden Sun 1 kg
						</td>
						<td class="align-middle text-right">0.75 €</td>
						<td class="align-middle text-right">2 u.</td>
						<td class="align-middle text-right">1.50 €</td>
					</tr>
					<tr> 
						<td class="align-middle">
							Arroz Golden Sun 1 kg
						</td>
						<td class="align-middle text-right">0.75 €</td>
						<td class="align-middle text-right">2 u.</td>
						<td class="align-middle text-right">1.50 €</td>
					</tr>
					<tr class="bg-info"> 
						<th colspan="3" scope="row" class="text-right">							
							Import total
						</td>
						<td class="align-middle text-right">7.50 €</td>
					</tr>
				</table>
				<div class="text-right">
					<a href="comprar.php" class="btn btn-outline-secondary mx-2">Afegir més productes</a>
					<a href="index.php" class="btn btn-secondary">Finalitzar la compra</a>
				</div>
			</div>
		</div>
	</body>
</html>
