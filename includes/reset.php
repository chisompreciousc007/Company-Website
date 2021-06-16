<?php 
session_start();
if(isset($_POST["submit"])){
    $token=$_POST["token"];
    $email=$_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    if(empty($password)||empty($confirm_password)){
        header("Location: ../reset.php?email=".$email."&token=".$token."&error=fill all fields");
        exit();
    }
    if($password!==$confirm_password){
        header("Location: ../reset.php?email=".$email."&token=".$token."&error=passwords do not match");
        exit();

    }
    if($password===$confirm_password){
        require 'db.php';
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        //CHECK IF EMAIL EXIST AND TOKEN MATCH
                 $sql = "SELECT * FROM users WHERE users.email=? AND users.token = ? LIMIT 1";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$email,$token]);
                if (!$stmt->rowCount()>0) {
                header("Location: ../reset.php?email=".$email."&token=".$token."&error=invalid email/token");
                exit();
            
                }
               
             //  UPDATE Password
                $sql = "UPDATE `users` SET `password`=? WHERE users.email=? AND users.token = ?";
                $stmt = $pdo->prepare($sql);
                $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
                $stmt->execute([$hashedPassword,$email,$token]);
                header("Location: ../login.php?username=".$email."&success=Passwordchanged");
                exit();
        }
}
else{

       header("Location: ../index.php");
       exit();
   };
?>