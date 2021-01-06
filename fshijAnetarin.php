<?php 
include_once('inc/sqlFunctions.php');
session_start();


if($_SESSION['roli']==1 && isset($_GET["aid"])){
    function fshijAnetarin(){
        $aid = $_GET["aid"];
        $dbcon = connection();
        
        $sql3 = "DELETE FROM anetari WHERE anetariid = $aid";
        $result1 = mysqli_query($dbcon, $sql3);
    
    if($result1 && $_SESSION["anetariid"]== $aid){
        echo "<script>alert('Keni fshire llogarine tuaj!');</script>";
        echo "<script>window.location.href = \"login.php\";</script>";
    }else if($result1){
        echo "<script>alert('Anetari u fshi me sukses!');</script>";
        echo "<script>window.location.href = \"anetaret.php\";</script>";
    }else{
        echo "<script>alert('Fshirja e anetarit deshtoi!');</script>";
    }
}

fshijAnetarin();
}else{
    echo "<script>alert('Kyquni si admin per te fshire anetarin!');</script>";
    echo "<script>window.location.href = \"anetaret.php\";</script>";
}

?>
