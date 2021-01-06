<?php

global $dbcon;
function connection(){
    $dbcon = mysqli_connect('localhost','root','','forumidb');
    if(!$dbcon){
        die(mysqli_error($dbcon));
    }
    return $dbcon;
}
connection();


function ktheAnetaret(){
    $dbcon = connection();
    $sql = "SELECT * FROM anetari ORDER BY anetariid DESC limit 5";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}

function kthePostimet($type){
    $dbcon = connection();
    $sql="";
    if($type==0)
    $sql = "SELECT
    p.*,
    DATE_FORMAT(p.data_e_krijimit, '%D %M') AS dataPostimit,
    COUNT(pl.postimiid) NrPelqimeve,
    a.username AS username,
    k.emri_kategoria AS kategoria,
    k.kategoriaid AS kID
FROM
    pelqimet pl
RIGHT JOIN postimi p ON
    p.postimiid = pl.postimiid
INNER JOIN anetari a ON
    p.anetariid = a.anetariid
INNER JOIN kategoria k ON
    p.kategoriaid = k.kategoriaid
GROUP BY p.postimiid
ORDER BY
    p.postimiid DESC
";
    else if($type==1)
        $sql = "SELECT titulli_postimit, postimiid FROM postimi ORDER BY postimiid DESC LIMIT 5";
    else if($type==2)
        $sql = "SELECT p.titulli_postimit, p.postimiid, a.username AS username FROM postimi p INNER JOIN komentet k ON p.postimiid = k.postimiid INNER JOIN anetari a ON k.anetariid = a.anetariid ORDER BY k.komentiid DESC LIMIT 5";
    else if($type==3)
        $sql = "SELECT p.*,  k.emri_kategoria AS kategoria, k.kategoriaid AS kID, a.username AS username, DATE_FORMAT(p.data_e_krijimit, '%d/%m/%Y') AS dataPostimit, COUNT(pl.postimiid) NrPelqimeve
        FROM postimi p INNER JOIN pelqimet pl ON p.postimiid = pl.postimiid INNER JOIN kategoria k ON p.kategoriaid = k.kategoriaid INNER JOIN anetari a ON p.anetariid=a.anetariid
        GROUP BY pl.postimiid
        ORDER BY NrPelqimeve DESC";
    else if($type==4){
        $sql = "SELECT p.*, k.emri_kategoria AS kategoria, k.kategoriaid AS kID, a.username AS username, DATE_FORMAT(p.data_e_krijimit, '%d/%m/%Y') AS dataPostimit, COUNT(pl.postimiid) NrPelqimeve FROM postimi p LEFT JOIN pelqimet pl ON p.postimiid = pl.postimiid INNER JOIN kategoria k ON p.kategoriaid = k.kategoriaid INNER JOIN anetari a ON p.anetariid = a.anetariid GROUP BY p.postimiid ORDER BY shikime DESC";
    }else if($type==5){
        $sql = "SELECT p.*, DATE_FORMAT(p.data_e_krijimit, '%D %M') AS dataPostimit, COUNT(pl.postimiid) NrPelqimeve, a.username AS username, k.emri_kategoria AS kategoria, k.kategoriaid AS kID
            FROM
                pelqimet pl
            RIGHT JOIN postimi p ON
                p.postimiid = pl.postimiid
            INNER JOIN anetari a ON
                p.anetariid = a.anetariid
            INNER JOIN kategoria k ON
                p.kategoriaid = k.kategoriaid
            GROUP BY p.postimiid
            ORDER BY
                NrPelqimeve DESC
            ";
    } 
        $result = mysqli_query($dbcon, $sql);
        return $result;
}

function kthePostimetKategoria($kid){
    $dbcon = connection();
    $sql = "SELECT p.*, DATE_FORMAT(p.data_e_krijimit, '%W %M %e') AS dataPostimit, a.username AS username, k.emri_kategoria AS kategoria FROM postimi p INNER JOIN anetari a ON p.anetariid=a.anetariid INNER JOIN kategoria k ON p.kategoriaid = k.kategoriaid WHERE p.kategoriaid = $kid";
    $result = mysqli_query($dbcon, $sql);
    if(mysqli_num_rows($result) != 0){
                return $result;
    }else{
        echo "<script>window.location.href = \"postimet.php\";</script>";
    }}

function merrPostimetEMia($aid){
    $dbcon = connection();
    $sql = "SELECT p.*, DATE_FORMAT(p.data_e_krijimit, '%W %M %e') AS dataPostimit, a.username AS username, k.emri_kategoria AS kategoria FROM postimi p INNER JOIN anetari a ON p.anetariid=a.anetariid INNER JOIN kategoria k ON p.kategoriaid = k.kategoriaid WHERE p.anetariid = $aid";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}

function merrPostiminID($id){
    $dbcon = connection();
    $sql = "SELECT dh.*, DATE_FORMAT(dh.data_e_krijimit, '%D %M') AS dataPostimit, a.username AS username, k.emri_kategoria AS kategoria, k.kategoriaid AS kID FROM dhoma_e_pritjes dh INNER JOIN anetari a ON dh.anetariid=a.anetariid INNER JOIN kategoria k ON dh.kategoriaid = k.kategoriaid";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}

function merrPostimin($id){
    $dbcon = connection();
    $sql = "SELECT p.*, DATE_FORMAT(p.data_e_krijimit, '%D %M') AS dataPostimit, a.username AS username, k.emri_kategoria AS kategoria, k.kategoriaid AS kID FROM postimi p INNER JOIN anetari a ON p.anetariid=a.anetariid INNER JOIN kategoria k ON p.kategoriaid = k.kategoriaid WHERE postimiid = $id";
    $result = mysqli_query($dbcon, $sql);
    if(mysqli_num_rows($result) != 0){
                return $result;
    }else{
        echo "<script>window.location.href = \"postimet.php\";</script>";
    }
}

function merrKomentet($postid){
    $dbcon = connection();
    $sql = "SELECT k.*, DATE_FORMAT(k.data_komentit, '%H:%i %p, %W') AS dataKomentit, a.username AS username FROM komentet k INNER JOIN anetari a ON a.anetariid = k.anetariid WHERE k.postimiid=$postid";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}

function login($username, $password){
    $dbcon = connection();
    $sql = "SELECT * FROM anetari WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($dbcon, $sql);
    if($result){
        if(mysqli_num_rows($result) == 1){
            $res = mysqli_fetch_assoc($result);
                header("Location: index.php");
                session_start();
                $_SESSION['anetariid'] = $res['anetariid'];
                $_SESSION['username'] = $res['username'];
                $_SESSION['isActive'] = $res['isActive'];
                $_SESSION['emri_mbiemri'] = $res['emri'];
                $_SESSION['roli'] = $res['roli'];
                $_SESSION['isActive'] = $res['isActive'];
            }else{
                echo "<script>alert('Username ose Password nuk jane ne rregull!');</script>";
            }
        }
}

function pelqePostimin($postimi, $user){
    $dbcon = connection();
    $sql = "INSERT INTO pelqimet(anetariid,postimiid) VALUES($user,$postimi)";
    $result = mysqli_query($dbcon, $sql);
    echo "<script>window.location.href = \"postimi.php?id=$postimi\";</script>";
}

function kontrolloPelqimin($postimi, $user){
    $dbcon = connection();
    $sql = "SELECT * FROM pelqimet WHERE anetariid = '$user' AND postimiid = '$postimi'";
    $result = mysqli_query($dbcon, $sql);
    if($result){
        if(mysqli_num_rows($result) !=0)
            return true;
        else 
            return false;
    }else
        return false;
}

function fshijKomentin($komentiid){
    $dbcon = connection();
    $sql = "DELETE FROM komentet WHERE komentiid = $komentiid";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}

function fshijPelqimin($postimi, $user){
    $dbcon = connection();
    $sql = "DELETE FROM pelqimet WHERE postimiid = $postimi AND anetariid = $user";
    $result = mysqli_query($dbcon, $sql);
    echo "<script>window.location.href = \"postimi.php?id=$postimi\";</script>";
}

function komentoPostimin($teksti,$postimi, $user){
    $dbcon = connection();
    $sql = "INSERT INTO komentet(postimiid,anetariid,teksti_komentit) VALUES($postimi,$user,'$teksti')";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}

function postimIRi($user,$teksti,$titulli,$kategoria){
    $dbcon = connection();
    $tekstiFix = str_replace("'","''",$teksti);
    $sql = "INSERT INTO dhoma_e_pritjes(anetariid,teksti_postimit,titulli_postimit,kategoriaid) VALUES($user,'$tekstiFix','$titulli',$kategoria)";
    $result = mysqli_query($dbcon, $sql);
    if($result){
        echo "<script>alert('Prisni deri sa admini te aprovoj postimin tuaj!');</script>";
        echo "<script>window.location.href = \"pa-aprovuar.php\";</script>";
    }else
        echo "<script>alert('Postimi deshtoi!');</script>";
}

function merrKategorite(){
    $dbcon = connection();
    $sql = "SELECT * FROM kategoria";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}

function fshijPostimin($postimi){
    $dbcon = connection();
    $sql = "DELETE FROM postimi WHERE postimiid = $postimi"; 
    $result = mysqli_query($dbcon, $sql);
    if($result){
        echo "<script>alert('Keni fshire postimin!');</script>";
        echo "<script>window.location.href = \"index.php\";</script>";
    }else
        echo "<script>alert('Fshirja deshtoi!');</script>";   
}

function signup($username, $password, $emri, $email){
    $dbcon = connection();
    $sql2 = "SELECT * FROM anetari WHERE username = '$username'";
    $result2 = mysqli_query($dbcon, $sql2);
    if(mysqli_num_rows($result2) != 0){
            echo "<script>alert('Ky username ekziston, zgjedhni nje tjeter username.');</script>";
            echo "<script>window.location.href = \"login.php\";</script>";
    }else{
            $sql = "INSERT INTO anetari(emri_mbiemri, email, username, password)";
            $sql.="VALUES('$emri','$email','$username', '$password')";
            $result = mysqli_query($dbcon, $sql);
            if($result){
                echo "<script>alert('Regjistrimi u krye me sukses!');</script>";
                echo "<script>window.location.href = \"login.php\";</script>";
            }else{
                echo "<script>alert('Regjistrimi deshtoi!');</script>";
                echo "<script>window.location.href = \"login.php\";</script>";
            }
    }
}


function kontrolloUsername($username){
    $dbcon = connection();

}


function merrPostimetDhoma(){
    $dbcon = connection();
    $sql = "SELECT dh.*, DATE_FORMAT(dh.data_e_krijimit, '%D %M') AS dataPostimit, a.username AS username, k.emri_kategoria AS kategoria, k.kategoriaid AS kID FROM dhoma_e_pritjes dh INNER JOIN anetari a ON dh.anetariid=a.anetariid INNER JOIN kategoria k ON dh.kategoriaid = k.kategoriaid";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}


function merrPostimetDhomaID($postimiid){
    $dbcon = connection();
    $sql = "SELECT dh.*, DATE_FORMAT(dh.data_e_krijimit, '%D %M') AS dataPostimit, a.username AS username, k.emri_kategoria AS kategoria, k.kategoriaid AS kID FROM dhoma_e_pritjes dh INNER JOIN anetari a ON dh.anetariid=a.anetariid INNER JOIN kategoria k ON dh.kategoriaid = k.kategoriaid WHERE dh.ppid = $postimiid";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}

function merrPostimetDhomaAnetari($anetariid){
    $dbcon = connection();
    $sql = "SELECT dh.*, DATE_FORMAT(dh.data_e_krijimit, '%D %M') AS dataPostimit, a.username AS username, k.emri_kategoria AS kategoria, k.kategoriaid AS kID FROM dhoma_e_pritjes dh INNER JOIN anetari a ON dh.anetariid=a.anetariid INNER JOIN kategoria k ON dh.kategoriaid = k.kategoriaid WHERE dh.anetariid = $anetariid";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}

function merrAnetaret(){
    $dbcon = connection();
    $sql = "SELECT * FROM anetari";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}

function rritShikimet($postimiid){
    $dbcon = connection();
    $sql = "SELECT * FROM postimi WHERE postimiid = $postimiid";
    $result = mysqli_query($dbcon, $sql);
    $postimi = mysqli_fetch_assoc($result);
    $shikimet = $postimi["shikime"];
    $shikimet++;
    $sql2 = "UPDATE postimi SET shikime = $shikimet WHERE postimiid = $postimiid";
    $result2 = mysqli_query($dbcon, $sql2);
    return $shikimet;
}

function merrPelqimet($postimiid){
    $dbcon = connection();
    $sql = "SELECT a.username AS username FROM pelqimet p INNER JOIN anetari a ON a.anetariid = p.anetariid WHERE p.postimiid = $postimiid";
    $result = mysqli_query($dbcon, $sql);
    return $result;
    // if($pelqimet == null){
    //     return 0;
    // }else
    // $nrPelqimeve = $pelqimet["NrPelqimeve"];
    //     return $nrPelqimeve;
}

function merrAnetarinID($anetariid){
    $dbcon = connection();
    $sql = "SELECT * FROM anetari WHERE anetariid = $anetariid";
    $result = mysqli_query($dbcon, $sql);
    $anetari = mysqli_fetch_assoc($result);
    return $anetari;
}

function ndryshoAnetarin($aid, $emri, $email, $username, $password, $roli, $isActive){
    $dbcon = connection();
    $sql = "UPDATE anetari SET emri_mbiemri = '$emri', email = '$email', username = '$username', password = '$password', roli = $roli, isActive = $isActive WHERE anetariid = $aid";
    $result = mysqli_query($dbcon, $sql);
    if($result){
        echo "<script>alert('Anetari u ndryshua me sukses!');</script>";
        echo "<script>window.location.href = \"anetari.php?aid=$aid\";</script>";
    }else{
        echo "<script>alert('Ndryshimi deshtoi!');</script>";
        echo "<script>window.location.href = \"index.php\";</script>";
    }
}

function shtoAnetarin($emri, $email, $username, $password, $roli, $isActive){
    $sql2 = "SELECT * FROM anetari WHERE username = '$username'";
    $dbcon = connection();
    $result2 = mysqli_query($dbcon, $sql2);
    if(mysqli_num_rows($result2) != 0){
            echo "<script>alert('Ky username ekziston, zgjedhni nje tjeter username.');</script>";
            echo "<script>window.location.href = \"anetaret.php\";</script>";
    }else{
        $sql = "INSERT INTO anetari(emri_mbiemri,email,username,password,isActive,roli) VALUES('$emri','$email','$username','$password',$isActive,$roli)";    
            $result = mysqli_query($dbcon, $sql);
            if($result){
                echo "<script>alert('Anetari u shtua me sukses!');</script>";
                echo "<script>window.location.href = \"anetaret.php\";</script>";
            }else{
                echo "<script>alert('Anetari deshtoi te shtohet!');</script>";
                echo "<script>window.location.href = \"anetaret.php\";</script>";
            }
    }
}

function merrPostimetAnetari($aid){
    $dbcon = connection();
    $sql = "SELECT p.*, DATE_FORMAT(p.data_e_krijimit, '%D %M') AS dataPostimit, COUNT(pl.postimiid) NrPelqimeve, a.username AS username, k.emri_kategoria AS kategoria, k.kategoriaid AS kID
    FROM
        pelqimet pl
    RIGHT JOIN postimi p ON
        p.postimiid = pl.postimiid
    INNER JOIN anetari a ON
        p.anetariid = a.anetariid
    INNER JOIN kategoria k ON
        p.kategoriaid = k.kategoriaid
    WHERE p.anetariid = $aid
    GROUP BY p.postimiid
    ORDER BY
        p.postimiid DESC
    ";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}





?>