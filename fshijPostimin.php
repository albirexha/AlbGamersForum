<?php 
include_once('inc/sqlFunctions.php');
session_start();


if($_SESSION['roli']==1 && isset($_GET["posID"])){
function fshijPostiminAdm(){
    $postimiid = $_GET["posID"];
    $dbcon = connection();
    $sql = "DELETE FROM postimi WHERE postimiid = $postimiid";
    $result = mysqli_query($dbcon,$sql);

    if($result){
        echo "<script>alert('Keni fshire postimin!');</script>";
        echo "<script>window.location.href = \"postimet.php\";</script>";
    }else{
        echo "<script>alert('Fshirja e postimit deshtoi!');</script>";
    }
}

fshijPostiminAdm();
}else{
    echo "<script>alert('Kyquni si admin per te fshire postimin!');</script>";
    echo "<script>window.location.href = \"postimet.php\";</script>";
}

?>
