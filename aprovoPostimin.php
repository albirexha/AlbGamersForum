<?php 
include_once('inc/sqlFunctions.php');
session_start();


if($_SESSION['roli']==1 && isset($_GET["posID"])){
function aprovoPostimin(){
    $postimiid = $_GET["posID"];
    $dbcon = connection();
    $sql = "SELECT * FROM dhoma_e_pritjes WHERE ppid = $postimiid";
    $result = mysqli_query($dbcon, $sql);
    $postimi = mysqli_fetch_assoc($result);

    $anetariid = $postimi["anetariid"];
    $titulli = $postimi["titulli_postimit"];
    $teksti = $postimi ["teksti_postimit"];
    $kategoria = $postimi ["kategoriaid"];
    $ppid = $postimi["ppid"];
    $tekstiFix = str_replace("'","''",$teksti);
    $sql1 = "INSERT INTO postimi(anetariid,teksti_postimit,titulli_postimit,kategoriaid) VALUES($anetariid,'$tekstiFix','$titulli',$kategoria)";
    $result1 = mysqli_query($dbcon, $sql1);
    if($result1){
        $sql2 = "DELETE FROM dhoma_e_pritjes WHERE ppid=$ppid";
        $result2 = mysqli_query($dbcon, $sql2);
        echo "<script>alert('Postimi u aprovua me sukses!');</script>";
        echo "<script>window.location.href = \"postimet.php\";</script>";
    }else{
        echo "<script>alert('Aprovimi i postimit deshtoi!');</script>";
        echo "<script>window.location.href = \"pa-aprovuar.php\";</script>";
    }

}

aprovoPostimin();
}else{
    echo "<script>alert('Kyquni si admin per te fshire postimin!');</script>";
    echo "<script>window.location.href = \"pa-aprovuar.php\";</script>";
}

?>
