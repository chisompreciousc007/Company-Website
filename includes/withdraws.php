<?php include "db.php";?>
<?php include "functions.php";?>

<?php
if (isset($_POST["submit"])) {
    $amount = $_POST["amount"];
    $balance = $_POST["balance"];
    $wallet = $_POST["wallet"];
    $username = $_POST["Username"];
    if (empty($amount) || empty($wallet)) {
        redirect("../withdraws.php?error=Fill all fields");
    }
    if ($amount > $balance) {
        redirect("../withdraws.php?error=Amount is greater than your available balance");
    }
    sendLog("Withdrawal application \n username:" . $username . "\n amount:" . $amount . "\n wallet:" . $wallet);
    redirect("../withdraws.php?success=Your withdrawal request was successful,You will be credited shortly");
} else {
    redirect("../signup.php?error=accessforbidden");

}
;
?>