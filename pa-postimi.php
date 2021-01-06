<?php include "inc/header.php" ?>
<?php
    if(isset($_GET["id"])){
        $postimi = merrPostimetDhomaID($_GET["id"]);
        $postimiR = mysqli_fetch_assoc($postimi);
        if(!((isset($_SESSION["anetariid"]) && $postimiR["anetariid"]==$_SESSION["anetariid"]) || (isset($_SESSION["roli"]) && $_SESSION["roli"]==1))){
            echo "<script>window.location.href = \"index.php\";</script>";
        }

        if(isset($_POST['fshijPostimin'])){
            fshijPostimin($_GET["id"]);
        }
    }else{
        echo "<script>window.location.href = \"index.php\";</script>";
    }
    ?> 

    <div id="wrapper">

        <div id="reader">
            <div id="thePost">
                <h4><?php echo $postimiR["titulli_postimit"]; ?></h4>

                <div class="comment_date"><?php echo $postimiR["dataPostimit"]; ?></div>
                <p>Postuar nga: <?php echo $postimiR["username"]; ?></p>
                <p class="postText"> <?php echo $postimiR["teksti_postimit"]; ?>
                <form id="login" action="" method="post">
                </form>
                </p>
            </div>
            
        </div>

        <?php include "inc/sidebar.php" ?>
    </div>

</body>
<?php include "inc/footer.php" ?>
</html>