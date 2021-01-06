<?php 
    include "inc/header.php";
    if((isset($_SESSION['roli']) && $_SESSION['roli']==1)){
        $postimetDhoma = merrPostimetDhoma();
    }else if(isset($_SESSION["anetariid"])){
        $postimetDhoma = merrPostimetDhomaAnetari($_SESSION["anetariid"]);
    }else{
        header("Location: index.php");
    }
?>
	<div id="wrapper">

		<div id="page">
        <?php if(mysqli_num_rows($postimetDhoma) == 0): ?>
						<div id="postimeNull"> 
							<h3> Nuk keni postime te pa aprovuara. </h3>
							<a class="btnLR" href="newPost.php">Posto tani </a>
						</div>
		<?php else: ?>
				<h2>Postimet e pa aprovuara</h2>
				<div class="table-wrapper">
					<table class="fl-table">
						<tbody>
							<tr>
								<th> Titulli </th>
								<th> Nga anetari</th>
								<th> Data </th>
								<th> Kategoria </th>
								<?php if(isset($_SESSION["anetariid"])): ?>
                                <th> Fshij </th>
                                <?php endif; ?>
                                <?php if(isset($_SESSION["roli"]) && $_SESSION["roli"]==1): ?>
                                <th> Aprovo </th>
                                <?php endif; ?>

							</tr>
							<?php 
                                while($postimi = mysqli_fetch_assoc($postimetDhoma)) :
                                $_SESSION["postimiAnetari"] = $postimi["anetariid"];
							?>
							<tr>
								<td> <a href="pa-postimi.php?id=<?php echo $postimi["ppid"] ?>"> <?php echo $postimi["titulli_postimit"] ?></td>
								<td> <?php echo $postimi["username"] ?></td>
								<td> <?php echo $postimi["dataPostimit"] ?></td>
								<td> <?php echo $postimi["kategoria"] ?></td>
								<?php if((isset($_SESSION["roli"]) && $_SESSION["roli"]==1) ||  $postimi["anetariid"]==$_SESSION["anetariid"]): ?>
                                <td> <a href="fshijPostiminPAP.php?posID=<?php echo $postimi["ppid"]."&aid=".$postimi["anetariid"]; ?> " onclick="return confirm('Deshironi te fshini postimin?');"> Fshij </td>
                                <?php endif; ?>
                                <?php if(isset($_SESSION["roli"]) && $_SESSION["roli"]==1): ?>
                                <td> <a href="aprovoPostimin.php?posID=<?php echo $postimi["ppid"]; ?> "> Aprovo </td>
                                <?php endif; ?>
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