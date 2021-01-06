<?php include "inc/header.php" ?>
<?php 
	if(isset($_SESSION['anetariid'])){
		$postimet = merrPostimetAnetari($_SESSION['anetariid']);
	}else{
		echo "<script>alert('Kyquni per te pare postimet e juaja!');</script>";
        echo "<script>window.location.href = \"index.php\";</script>";
	}
?>
	<div id="wrapper">

		<div id="page">
				<?php if(mysqli_num_rows($postimet) == 0): ?>
						<div id="postimeNull"> 
							<h3> Ju nuk keni bere ende postime. </h3>
							<a class="btnLR" href="newPost.php">Posto tani </a>
						</div>
				<?php else: ?>
						<h2>Postimet e mia</h2>
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
									</tr>
									<?php 
										while($postimi = mysqli_fetch_assoc($postimet)) :
									?>
									<tr>
									<td> <a href="postimi.php?id=<?php echo $postimi["postimiid"] ?>"> <?php echo $postimi["titulli_postimit"] ?></td>
									<td> <?php echo $postimi["username"] ?></td>
									<td> <?php echo $postimi["NrPelqimeve"] ?></td>
									<td> <?php echo $postimi["shikime"] ?></td>
									<td> <a href="postimet-kategoria.php?idK=<?php echo $postimi["kID"]; ?> "> <?php echo $postimi["kategoria"] ?></td>
									<td> <?php echo $postimi["dataPostimit"] ?></td>
									</tr>
									<?php endwhile; ?>
								<tbody>
							</table>
						</div>
						<?php endif; ?>
		</div>
		<?php include "inc/sidebar.php" ?>
	</div>
	</div>
	<?php include "inc/footer.php" ?>

</body>

</html>