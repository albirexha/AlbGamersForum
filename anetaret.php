<?php include "inc/header.php" ?>
	<?php if(!isset($_SESSION["anetariid"])){
		    echo "<script>alert('Kyquni per te lexuar postimin!');</script>";
			echo "<script>window.location.href = \"index.php\";</script>";
	}?>
	<div id="wrapper">

		<div id="page">
				<h2>Anetaret</h2>
				<a href="anetari.php?shto=1" class="btnPost" style="float:right; display:inline; margin-bottom: 20px">Shto Anetar </a>
				<div class="table-wrapper">
					<table class="fl-table">
						<tbody>
							<tr>
								<th style="width: auto"> Emri </th>
								<th> Email</th>
								<th> Username </th>
                                <th> isActive </th>
                                <th> Roli </th>
                                <th> Fshij </th>
                                <th> Ndrysho </th>
							</tr>
							<?php 
								$anetaret = merrAnetaret();
								while($anetari = mysqli_fetch_assoc($anetaret)) :
							?>
							<tr>
                                <td> <?php echo $anetari["emri_mbiemri"] ?></td>
								<td> <?php echo $anetari["email"] ?></td>
								<td> <?php echo $anetari["username"] ?></td>
								<td> <?php if($anetari["isActive"]==0) echo "No" ; else echo "Yes"; ?></td>
								<td> <?php if($anetari["roli"]==2) echo "User" ; else echo "Admin"; ?></td>
                                <td> <a href="fshijAnetarin.php?aid=<?php echo $anetari["anetariid"]; ?>" onclick="return confirm('Deshironi te fshini anetarin?');"> Fshije </td>
                                <td> <a href="anetari.php?aid=<?php echo $anetari["anetariid"]; ?> "> Ndrysho </td>
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