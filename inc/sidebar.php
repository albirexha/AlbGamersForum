<div id="sidebar">
            <div id="stwo-col">
                <div class="sbox1">
                    <h2>Postimet me te reja</h2>
                    <ul class="style2">
                        <?php $postimetNew = kthePostimet(1);
                              while($postimi = mysqli_fetch_assoc($postimetNew)):
                        ?>
                        <li class="icon icon-ok"><a href="postimi.php?id=<?php echo $postimi["postimiid"]; ?>"><?php echo $postimi["titulli_postimit"]?></a></li>
                              <?php endwhile; ?>
                    </ul>
                </div>
            </div>
            <div id="stwo-col">
                <div class="sbox2">
                    <h2>Komentet me te reja</h2>
                    <ul class="style2">
                        <?php $komentetNew = kthePostimet(2);
                              while($komenti = mysqli_fetch_assoc($komentetNew)):
                        ?>
                        <li class="icon icon-ok"><a href="postimi.php?id=<?php echo $komenti["postimiid"]; ?>"><?php echo $komenti["titulli_postimit"]; ?> </a> / <?php echo '<p style="display: inline; color: yellow">'. $komenti["username"] .'</p>'?></li>
                              <?php endwhile; ?>
                    </ul>
                </div>
            </div>
</div>