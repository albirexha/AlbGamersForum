<?php include "inc/header.php" ?>
<?php
    $shtoA = false;
    if((isset($_GET["shto"]) && $_SESSION["roli"]==1)){
        $shtoA = true;
    }else if((isset($_GET["aid"]) && $_GET["aid"] == $_SESSION["anetariid"]) || ($_SESSION["roli"]==1 && isset($_GET["aid"]))){
        $anetari = merrAnetarinID($_GET["aid"]);
    }else
        echo "<script>window.location.href = \"index.php\";</script>";
    

    if(isset($_POST["ndrysho"])){
        $emri = $_POST["emri"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $aid = $anetari["anetariid"];
        if($_SESSION["roli"]==1){
            $roli = $_POST["roli"];
            $isActive = $_POST["isActive"];
            ndryshoAnetarin($aid, $emri, $email, $username, $password, $roli, $isActive);
        }else{
            ndryshoAnetarin($aid, $emri, $email, $username, $password, $anetari["roli"], $anetari["isActive"]);
        }
    }

    if(isset($_POST["shtoAnetar"])){
        $emri = $_POST["emri"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $roli = $_POST["roli"];
        $isActive = $_POST["isActive"];
        shtoAnetarin($emri, $email, $username, $password, $roli, $isActive);
    }


    ?>
<div id="wrapper">
        <div id="newPost">
            <?php if(!$shtoA): ?>
            <h2>Llogaria ime</h2>
                <form method="post" id="profili" >
                <input type="text" placeholder="Emri dhe mbiemri" name="emri" value="<?php echo $anetari["emri_mbiemri"];?>" style="margin-top: 60px">
                <?php if($anetari["roli"]==1 || $_SESSION["roli"]==1): ?>
                <select name="roli">
                          <option <?php if($anetari["roli"]==1) echo "selected"; ?> value="1">Admin</option>
                          <option <?php if($anetari["roli"]==2) echo "selected"; ?> value="2">User</option>
                </select>
                <?php endif;?>
                <?php if($_SESSION["roli"]==2):?>
                    <div id="profileImg"> </div>
                <?php endif; ?>
                <input type="email" placeholder="Email" name="email" value="<?php echo $anetari["email"];?>">
                <?php if($anetari["roli"]==1 || $_SESSION["roli"]==1): ?>
                <select name="isActive" style="margin-top: 40px">
                    <option selected disabled hidden>isActive</option>
                        <option <?php if($anetari["isActive"]==1) echo "selected"; ?> value="1">Active</option>
                        <option <?php if($anetari["isActive"]==0) echo "selected"; ?> value="0">Deactivated</option>
                </select>
                <?php endif; ?>
                <input type="text" placeholder="Username" name="username" value="<?php echo $anetari["username"]?>" >
                <input type="password" placeholder="Password" name="password" id="pwinput" value="<?php echo $anetari["password"]?>">
                <div id="showPw" onclick="myFunction()">
                <p> Shiko password </p>
                </div>
                <input type="submit" name="ndrysho" class="button" value="Ndrysho" >
            </form>
        </div>
            <?php else: ?>
                <h2>Shto anetar</h2>
                <form method="post" id="profili" >
                <input type="text" placeholder="Emri dhe mbiemri" name="emri" style="margin-top: 60px">
                <select name="roli">
                          <option value="1">Admin</option>
                          <option selected value="2"> User</option>
                </select>
                <input type="email" placeholder="Email" name="email" value="">
                <select name="isActive" style="margin-top: 40px">
                    <option selected disabled hidden>isActive</option>
                        <option selected value="1">Active</option>
                        <option value="0">Deactivated</option>
                </select>
                <input type="text" placeholder="Username" name="username" >
                <input type="password" placeholder="Password" name="password" id="pwinput">
                <div id="showPw" onclick="myFunction()">
                <p> Shiko password </p>
                </div>
                <input type="submit" name="shtoAnetar" class="button" value="Shto anetarin" >
            </form>
            </div>
            <?php endif; ?>
        <?php include "inc/sidebar.php" ?>
    </div>
    </div>
    <?php include "inc/footer.php" ?>
</body>
                          <script>
                              function myFunction() {
                                var x = document.getElementById("pwinput");
                                    if (x.type === "password") {
                                        x.type = "text";
                                    } else {
                                        x.type = "password";
                                    }
                                }
                          </script>
</html>