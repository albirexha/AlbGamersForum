<?php include "inc/header.php" ?>
<?php
    if(isset($_GET["id"]) && isset($_SESSION['anetariid'])){
        $postimi = merrPostimin($_GET["id"]);
        $postimiid = $_GET["id"];
        $pelqimetResult = merrPelqimet($postimiid);
        //$pelqimetAll = mysqli_fetch_assoc($pelqimetResult);
        if(mysqli_num_rows($pelqimetResult)>0){
            $pelqimet = mysqli_num_rows($pelqimetResult);
        }else{
            $pelqimet = 0;
        }
        $postsubmit = false;
        if(isset($_POST['submit']) || isset($_POST['like']) || isset($_POST['unlike']) || isset($_POST['komentoPost']) || isset($_POST['reply']) || isset($_POST['deleteKoment'])){
            $postsubmit = true;
        }
        if(!$postsubmit)
            $shikimet = rritShikimet($postimiid);
    }else{
        echo "<script>alert('Kyquni per te lexuar postimet!');</script>";
        echo "<script>window.location.href = \"index.php\";</script>";
    }
    



    $postimiR = mysqli_fetch_assoc($postimi);
    $userid = $postimiR["anetariid"];
    $postusername = $postimiR["username"];
    $komentet = merrKomentet($_GET["id"]);
    if(isset($_POST['like'])){
        pelqePostimin($_GET["id"], $_SESSION['anetariid']);
    }

    if(isset($_POST['unlike'])){
        fshijPelqimin($_GET["id"], $_SESSION['anetariid']);
    }
    
    if(isset($_POST['komentoPost'])){
        if(strlen($_POST['komentiTekst'])<10){
            echo "<script>alert('Komenti duhet te kete se paku 10 karaktere!');</script>";
            echo "<script>window.location.href = \"postimi.php?id=$postimiid\";</script>";
        }else{
                $result = komentoPostimin($_POST['komentiTekst'],$_GET["id"], $_SESSION['anetariid']);
            if($result){
                echo "<script>window.location.href = \"postimi.php?id=$postimiid\";</script>";
            }else{
                echo "<script>alert('Komentimi deshtoi!');</script>";
                echo "<script>window.location.href = \"postimi.php?id=$postimiid\";</script>";
            }
        }
    }

    if(isset($_POST['reply'])){
        header('Location: postimi.php?id='.$_GET["id"].'#newComment');
    }
    $isLiked = kontrolloPelqimin($_GET["id"], $_SESSION['anetariid']);

    if(isset($_POST['fshijPostimin'])){
        fshijPostimin($_GET["id"]);
    }

    if(isset($_POST['deleteKoment'])){
        $result = fshijKomentin($_POST["komentiid"]);
        if($result){
            echo "<script>alert('Keni fshire komentin!');</script>";
            echo "<script>window.location.href = \"postimi.php?id=$postimiid\";</script>";
        }else{
            echo "<script>alert('Fshirja e komentit deshtoi!');</script>";
            echo "<script>window.location.href = \"postimi.php?id=$postimiid\";</script>";
        }
    }

    ?> 

    

    <div id="wrapper">

        <div id="reader">
            <div id="thePost">
                <h4><?php echo $postimiR["titulli_postimit"]; ?></h4>

                <div class="comment_date" style="text-align: right"><?php echo $postimiR["dataPostimit"]; ?> 
                <p style="color: red; font-size: 14"> Shikime: <?php echo $shikimet; ?> / Pelqime: <?php echo $pelqimet; ?></p>
                <?php if($pelqimet>0): ?>
                <div id="popUpBox">
                <div id="closeModal"></div>
                        <div id="boxUsers">
                            <?php
                                while($pelqimi = mysqli_fetch_assoc($pelqimetResult)){
                                    $username = $pelqimi["username"];
                                    echo "<h2> $username </h2>";
                                }
                            ?>
                        </div>
                </div>
                    <button id="openUsers" class="btnSHL">Shiko pelqimet</button>
                <?php endif; ?>
                </div>
                <p>Postuar nga: <span style="color: yellow; cursor: pointer;" onclick="window.location='postimet.php?uidposts=<?php echo $userid ?>' "> <?php echo $postimiR["username"]; ?> </span></p>
                <p class="postText"> <?php echo $postimiR["teksti_postimit"]; ?>
                <form id="login" action="" method="post">
                <input type="submit" value="Reply" name="reply" id="replyy">
                <?php if($isLiked){ ?>
                <input type="submit" id="like" value="UnLike" name="unlike">
                <?php }else{ ?>
                <input type="submit" value="Like" name="like" id="like"> <?php }?>
                <?php if($_SESSION['anetariid'] == $postimiR["anetariid"] || $_SESSION['roli'] ==1): ?>
                <input type="submit" name="fshijPostimin" id="fshijPost" onclick="return confirm('Deshironi te fshini postimin?');" value="Delete">
                <?php endif; ?>
                
                </form>
                </p>


            </div>
            <ol>
                
                <h3 id="CommentsS">Comments</h3>

                <?php while($komenti = mysqli_fetch_assoc($komentet)): ?>
                <li>
                    <div class="comment_box">
                        <div class="inside_comment">
                            <div class="comment-meta">
                                <div class="commentsuser" style="color: yellow;"><?php echo $komenti["username"]; ?></div>
                                <div class="comment_date"><?php echo $komenti["dataKomentit"]; ?></div>
                            </div>
                        </div>

                        <div class="comment-body" >
                            <p> <?php echo $komenti["teksti_komentit"]; ?>
                            <form method="post">
                            <?php if($_SESSION['anetariid'] == $komenti["anetariid"] || $_SESSION['anetariid'] == $postimiR["anetariid"] || $_SESSION['roli']==1): ?>
                            <input type="text" name="komentiid" hidden value="<?php echo $komenti['komentiid']; ?>">
                            <input type="submit" name="deleteKoment" value="Delete" onclick="return confirm('Deshironi te fshini komentin?');">
                            <?php endif; ?>
                            </form>
                            </p>
                        </div>

                    </div>
                </li>
                    <?php endwhile; ?>
                
                <li>
                    <div class="comment_box" id="commentboxx" >
                        <h2 style="text-align: center; margin: 30px; margin-top: 5px;"> Komento tani </h2>
                        <div id="newComment">
                            <form method="post">
                            <textarea id="textarea" name="komentiTekst">Komenti juaj...</textarea>
                            <div id="replyBtn">
                            <input style="margin-top:20px " type="submit" name="komentoPost" value="Komento">
                            </div>
                            </form>
                        </div>
                    </div>

                </li>
            </ol>
        </div>
                                
        <?php include "inc/sidebar.php" ?>
    </div>
    <?php  
    if($_SESSION['isActive']==0 && $_SESSION["roli"]==2){
    
    ?>    
    <script>
    document.getElementById("commentboxx").style.display = 'none';
    document.getElementById("replyy").style.display = 'none';
    document.getElementById("like").style.display = 'none';
    </script>
    <?php } ?>
    </div>
    <?php include "inc/footer.php" ?>
</body>
        <script>

var openUsers = document.getElementById("openUsers");
var popup = document.getElementById("popUpBox");
openUsers.onclick = function(){
    var close = document.getElementById('closeModal');
    popup.style.display = "block";
    close.innerHTML = 'Anetaret qe pelqyen kete postim <button onclick="Alert.ok()">Close</button>';
    close.style.display = "block";
    close.onclick = function(){
        popup.style.display = "none";
        close.style.display = "none";
    }
}

$(document).mouseup(function(e) 
{
    var container = $("#popUpBox");

    if (!container.is(e.target)) 
    {
        container.hide();
    }
});

$(document).ready(function(){
    $("#likeee").click(function(){
        console.log("asd");
        var r = confirm("A jeni i sigurte?");
        if(r)
            return true;
        else
            return false;
    });
});

function validatee(){
    var result = confirm("Do you accept!");
    return result;
}

var likeBtn = document.getElementyById("likeee");
likeBtn.onclick = function(){
    console.log("asd");
        var r = confirm("A jeni i sigurte?");
        if(r)
            return true;
        else
            return false;
}

</script>
</html>