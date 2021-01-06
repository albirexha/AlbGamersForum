    <?php include "inc/header.php" ?>
    <?php
    if(!isset($_SESSION['anetariid'])){
        echo "<script>alert('Kyquni qe te mund te postoni!');</script>";
        echo "<script>window.location.href = \"login.php\";</script>";        
    }

    if($_SESSION['isActive']==0){
        echo "<script>alert('Llogaria juaj eshte deaktivizuar, ju nuk mund te postoni.!');</script>";
        echo "<script>window.location.href = \"index.php\";</script>";
    }
    if(isset($_SESSION['anetariid'])){
        
    }else{
        echo "<script>alert('Kyquni per te postuar!');</script>";
        echo "<script>window.location.href = \"index.php\";</script>";
    }

    if(isset($_POST["posto"])){
        if(!isset($_POST["kategoriaid"])){
            echo "<script>alert('Plotso te gjitha format!!');</script>";
            echo "<script>window.location.href = \"newPost.php\";</script>";
        }else{
        $user = $_SESSION['anetariid'];
        $titulli = $_POST["titulli"];
        $kategoria = $_POST["kategoriaid"];
    
        $teksti = $_POST["message-area"];
        }
        if($titulli == null || $kategoria == null || $teksti == null){
            echo "<script>alert('Plotso te gjitha format!!');</script>";
            echo "<script>window.location.href = \"newPost.php\";</script>";

        }else
            postimIRi($user,$teksti,$titulli,$kategoria);
    }


    ?>
    <div id="wrapper">
        <div id="newPost">
            <h2>Postim i ri</h2>
                <form method="post" id="shtoForma">
                <input type="text" placeholder="Titulli i temes" name="titulli">
                <select name="kategoriaid">
                    <option selected disabled hidden>Zgjedh kategorine</option>
                    <?php $kategorite = merrKategorite();
                            
                          while($kategoria = mysqli_fetch_assoc($kategorite)): ?>
                          <option value="<?php echo $kategoria['kategoriaid'];?>"><?php echo $kategoria["emri_kategoria"];?></option>
                    <?php endwhile; ?>      
                </select>
                <textarea id="textare" maxlength="1500" name="message-area" placeholder="Please enter your message"></textarea>
                <span id="rchars" style="margin-left:10px; color: white">1500</span> Character(s) Remaining
                <input style="margin-top:0px" type="submit" name="posto" class="button" value="Posto">
                          
            </form>
        </div>

        <?php include "inc/sidebar.php" ?>
    </div>
    </div>
    <?php include "inc/footer.php" ?>
    </body>
                          <script> 
                        var maxLength = 1500;
$('textarea').keyup(function() {
  var textlen = maxLength - $(this).val().length;
  $('#rchars').text(textlen);
});
                        </script>
</html>