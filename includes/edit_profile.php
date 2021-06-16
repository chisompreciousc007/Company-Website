<?php
require_once 'functions.php';
if (isset($_POST["edit1"])) {
    require 'db.php';
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    if (empty($fullname)) {
        redirect("../editprofile.php?error=fill all fields");
    }
    $sql = "UPDATE users SET full_name=? WHERE users.username=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$fullname, $username]);
    redirect("../profile.php?success=Account Name Update Successful");
}
if (isset($_POST["edit2"])) {
    require 'db.php';
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $bitcoin = $_POST["bitcoin"];
    $username = $_POST["username"];
    if (empty($bitcoin)) {
        redirect("../editprofile.php?error=fill all fields");
    }
    $sql = "UPDATE users SET bitcoin=? WHERE users.username=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$bitcoin, $username]);
    redirect("../profile.php?success=Bitcoin Wallet Update Successful");
}
if (isset($_POST["edit3"])) {
    require 'db.php';
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $bitcash = $_POST["bitcash"];
    $username = $_POST["username"];
    if (empty($bitcash)) {
        redirect("../editprofile.php?error=fill all fields");
    }
    $sql = "UPDATE users SET bitcash=? WHERE users.username=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$bitcash, $username]);
    redirect("../profile.php?success=Bitcash Wallet Update Successful");
}
if (isset($_POST["edit4"])) {
    require 'db.php';
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    $username = $_POST["username"];
    if (empty($password) || empty($password2)) {
        redirect("../editprofile.php?error=fill all fields");
    }
    if ($password !== $password2) {
        redirect("../editprofile.php?error=Password do not match");
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password=? WHERE users.username=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$hashedPassword, $username]);
    redirect("../profile.php?success=Password Update Successful");
} else {
    redirect("../login.php?error=accessforbidden");
}
