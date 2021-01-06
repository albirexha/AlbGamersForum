<?php 
include_once('inc/sqlFunctions.php');
session_start();


if($_SESSION['roli']==1 && isset($_GET["posID"]) || isset($_GET["aid"])==$_SESSION["anetariid"]){
function fshijPostiminAdm(){
    $postimiid = $_GET["posID"];
    $dbcon = connection();
    $sql = "DELETE FROM dhoma_e_pritjes WHERE ppid = $postimiid";

    $result = mysqli_query($dbcon, $sql);
    if($result){
        echo "<script>alert('Keni fshire postimin!');</script>";
        echo "<script>window.location.href = \"pa-aprovuar.php\";</script>";
    }else{
        echo "<script>alert('Fshirja e postimit deshtoi!');</script>";
    }
}

fshijPostiminAdm();
}else{
    echo "<script>alert('Kyquni si admin per te fshire postimin!');</script>";
    echo "<script>window.location.href = \"pa-aprovuar.php\";</script>";
}

?>
