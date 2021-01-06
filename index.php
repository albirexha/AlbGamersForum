	<?php include "inc/header.php" ?>
	<div id="wrapper">
		<div id="page">
		<?php if(isset($_SESSION["anetariid"]) && $_SESSION["isActive"]==0):?>
		<div id="userDisabled"> <h1> Llogaria juaj eshte deaktivizuar! </h1> </div>
		<?php endif; ?>
				<h2>TOP POSTS</h2>
				<div class="table-wrapper">
					<table class="fl-table">
						<tbody>
							<tr>
								<th> Titulli </th>
								<th> Nga anetari </th>
								<th> Pelqime </th>
								<th> Shikime </th>
								<th> Kategoria </th>
								<th> Data </th>
							</tr>
							<?php 
								$postimet = kthePostimet(3);
								while($postimi = mysqli_fetch_assoc($postimet)) :
							?>
							<tr>
								<td> <a href="postimi.php?id=<?php echo $postimi["postimiid"] ?>"> <?php echo $postimi["titulli_postimit"] ?></td>
								<td> <a style="color: yellow" href="postimet.php?uidposts=<?php echo $postimi["anetariid"]; ?>"> <?php echo $postimi["username"] ?></td>
								<td> <?php echo $postimi["NrPelqimeve"] ?></td>
								<td> <?php echo $postimi["shikime"] ?></td>
								<td> <a style="color: #FF00FF" href="postimet-kategoria.php?idK=<?php echo $postimi["kID"]; ?> "> <?php echo $postimi["kategoria"] ?></td>
								<td> <?php echo $postimi["dataPostimit"] ?></td>
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