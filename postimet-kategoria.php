<?php include "inc/header.php" ?>
<?php if(isset($_GET["idK"])){
        $postimetK = kthePostimetKategoria($_GET["idK"]);
      }else
       header("Location: index.php");
?>    
<div id="wrapper">

		<div id="page">
				<h2>Kategoria: <span id="titulliK" style="color: #FF00FF">  </span></h2>
				<div class="table-wrapper">
					<table class="fl-table">
						<tbody>
							<tr>
								<th> Titulli </th>
								<th> Postuar nga </th>
								<th> Data </th>
								<th> Kategoria </th>
							</tr>
							<?php 
                                while($postimi = mysqli_fetch_assoc($postimetK)) :
                                echo '<script> $("#titulliK").html("'.$postimi["kategoria"].'"); </script>';
							?>
							<tr>
                                
								<td> <a href="postimi.php?id=<?php echo $postimi["postimiid"] ?>"> <?php echo $postimi["titulli_postimit"] ?></td>
								<td> <?php echo $postimi["username"] ?></td>
								<td> <?php echo $postimi["dataPostimit"] ?></td>
								<td> <?php echo $postimi["kategoria"] ?></td>
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