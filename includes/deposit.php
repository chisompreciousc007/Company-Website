<?php 
if (isset($_POST["submit_deposit"])) {
    session_start();
    require 'db.php';
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    $amount =  $_POST["amount"];
    $username=$_SESSION["Username"];

    if (empty($amount)) {
        header("location:../deposit.php?error=emptyfields");
        exit();
    }
  //  UPDATE Data
  $sql = "UPDATE `users` SET `least_pledge`=? WHERE username=?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$amount,$username]);
//   header("location:../account.php?success=pledgedupdated");
//   exit();


//  GEt least PLEDGE InFO 
$sql = "SELECT least_pledge FROM users WHERE  username =? LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$row = $stmt->fetch();
$_SESSION["Least_pledge"]= $row->least_pledge;


//  GEt PHER InFO 
$sql = "SELECT * FROM phers WHERE  username =? LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$row = $stmt->fetch();
$_SESSION["pher"]= $row;
header("location:../account.php?success=pledgedupdated");
exit();
}else{
    header("location:../login.php?error=accessforbidden");
    exit();
}
     ?>