<?php include "inc/header.php" ?>
	<?php 
		if(!isset($_SESSION["anetariid"])){
		    echo "<script>alert('Kyquni per te lexuar postimet!');</script>";
			echo "<script>window.location.href = \"index.php\";</script>";
		}else if(isset($_GET["filtrimi"]) && ($_GET["filtrimi"]==4 || $_GET["filtrimi"])==5){
			$postimet = kthePostimet($_GET["filtrimi"]);
		}else if(isset($_GET["uidposts"])){
			$postimet = merrPostimetAnetari($_GET["uidposts"]);
		}else
			$postimet = kthePostimet(0);
		
		 if(isset($_POST["filtro"])){
			 $filtrimi = $_POST["filtrimi"];
			echo "<script>window.location.href = \"postimet.php?filtrimi=$filtrimi\";</script>";
		 }
	?>
	<div id="wrapper">
		<div id="page" style="margin-top: 10px">
		<?php if(!isset($_GET["uidposts"])): ?>
		<div class="filtro" style="margin: auto 0">
		<form method="post" id="postimi">
				<h3 style="margin-left:25%">Filtro sipas: </h3>
				<select name="filtrimi">
                        <option style="background-color: black; height: 100px;" selected value="4">Shikimeve</option>
                        <option style="background-color: black" value="5">Pelqimeve</option>
				</select>
				<input type="submit" name="filtro" value="Filtro">
		</form>
		</div>
		<?php endif; ?>
					<?php 
					if(isset($_GET["filtrimi"]) && $_GET["filtrimi"]==5)
						echo "<h2>Postimet e radhitura sipas pelqimeve</h2>";
					else if(isset($_GET["filtrimi"]) && $_GET["filtrimi"]==4)
						echo "<h2>Postimet e radhitura sipas shikimeve</h2>";
					else if(isset($_GET["uidposts"]))
						 echo "<h2 style=\" margin-top: 20px \">Postimet e  <span id=\"titulliK\" style=\"color: yellow;\"> </h2>";
					else
						echo "<h2>Te gjitha postimet</h2>";
				?>
				<div class="table-wrapper">
					<table class="fl-table">
						<tbody>
							<tr>
								<th> Titulli </th>
								<th> Nga anetari</th>
								<th> Pelqime </th>
								<th> Shikime </th>
								<th> Kategoria </th>
								<th> Data </th>
								<?php if(isset($_SESSION["roli"]) && $_SESSION["roli"]==1): ?>
								<th> Fshij </th>
								<?php endif; ?>
							</tr>
							<?php 
								while($postimi = mysqli_fetch_assoc($postimet)) :
								echo '<script> $("#titulliK").html("'.$postimi["username"].'"); </script>';
							?>
							<tr>
								<td> <a href="postimi.php?id=<?php echo $postimi["postimiid"] ?>"> <?php echo $postimi["titulli_postimit"] ?></td>
								<td> <a style="color: yellow" href="postimet.php?uidposts=<?php echo $postimi["anetariid"] ?>"> <?php echo $postimi["username"] ?></td>
								<td> <?php echo $postimi["NrPelqimeve"] ?></td>
								<td> <?php echo $postimi["shikime"] ?></td>
								<td> <a style="color: #FF00FF" href="postimet-kategoria.php?idK=<?php echo $postimi["kID"]; ?> "> <?php echo $postimi["kategoria"] ?></td>
								<td> <?php echo $postimi["dataPostimit"] ?></td>
								<?php if(isset($_SESSION["roli"]) && $_SESSION["roli"]==1): ?>
								<td> <a href="fshijPostimin.php?posID=<?php echo $postimi["postimiid"]; ?> "> Fshij </td>
								<?php endif; ?>
							</tr>
							<?php endwhile; ?>
						<tbody>
					</table>
				</div>
		</div>
		<?php include "inc/sidebar.php" ?>
	</div>
	</div>
	<?php include "inc/footer.php" ?>

</body>

</html>