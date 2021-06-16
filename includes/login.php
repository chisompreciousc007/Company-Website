<?php include "functions.php";
require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
if ($_ENV['APP_ENV'] === "prod") {
    $PublicIP = get_client_ip();
    $json = file_get_contents("http://ipinfo.io/$PublicIP/geo");
    $json = json_decode($json, true);
    $country = $json['country'];
    $region = $json['region'];
    $city = $json['city'];
}
?>

<?php
if (isset($_POST["submit"])) {
    require 'db.php';
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $username = strtolower($_POST["username"]);
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        redirect("../login.php?error=fil all fields");

    }
    if (!login_exists($username)) {
        redirect("../login.php?error=username/email does not exist");

    }

    //USER INFO
    $user = $stmt->fetch();
//CHECK IF VERIFIED
    if (!$user->verified) {
        redirect("../verify_email.php?email=" . $user->email . "&error=verify your email");

    }

//CHECK IF BLOCKED
    if ($user->blocked) {
        redirect("../signup.php?email=" . $user->email . "&error=account is blocked");

    }

    $passcheck = password_verify($password, $user->password);
    if ($passcheck == false) {
        redirect("../login.php?error=invalid username or password");

    }

    if (!isset($_SESSION)) {
        session_start();
    }

    $_SESSION["Username"] = $user->username;

    if ($_ENV['APP_ENV'] === "prod") {sendLog("Login  \n username:" . $user->username . "\n Country:" . $country . "\n" . $city . ".");} else {sendLog("Login  \n username:" . $user->username);}
    redirect("../dashboard.php");
} else {
    redirect("../login.php?error=accessforbidden");

}
?>