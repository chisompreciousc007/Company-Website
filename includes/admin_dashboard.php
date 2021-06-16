<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
require 'db.php';
require_once 'functions.php';
if (isset($_POST["confirm_deposit"])) {
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $amount = $_POST["amount"];
    $username = $_POST["username"];
    $type = $_POST["type"];

    if (empty($username) || empty($amount) || empty($type)) {
        redirect("../admin_dashboard.php?error=Fill all fields!");
    }
    if (username_exists($username)) {
        // echo $amount, $username, $type;exit;
        $sql = "SELECT email,full_name FROM users WHERE  users.username =? LIMIT 1 ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        $email = $user->email;
        $fullName = $user->full_name;
        //  CREATE PAYMENT SLIP
        $sql = "INSERT INTO deposit_history (username,amount,type) VALUES (?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $amount, $type]);
        // UPDATE CONTRACT AMOUNT
        $sql = "UPDATE users SET contract_amount=? WHERE  users.username =?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$amount, $username]);

//SEND EMAIL FOR VERIFICATION
        // Load Composer's autoloader
        require '../vendor/autoload.php';

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->SMTPSecure = "ssl"; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->Username = $_ENV['SMTP_USER'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->Port = $_ENV['SMTP_PORT'];
            $mail->isHTML(true); // Set email format to HTML

            //Recipients
            $mail->setFrom('noreply@marketexchangefx.com', 'MarketExchangeFX Ltd');
            $mail->addAddress($email, $fullName); // Add a recipient

            $mail->Subject = 'Deposit Confirmation';
            $mail->Body = '<p>Hello ' . $fullName . ',<br> Your deposit of <h3 style="display:inline">$' . $amount . '</ h3> have been confirmed.</p>
      <p> We look forward to a great partnership with you, Enjoy your journey of financial Freedom.  </p>
       <br>
       <p>Do you have any questions? Visit our <a href="www.marketexchangefx.com/faq.php" >FAQ</a > page. </p>
       <br>
       <p>If you did not attempt to make deposit, please ignore this email. </p>
       <br>
       <p>Thanks,</p>
       <p>MarketExchangeFX Ltd</p>
       <hr>
       <p>© 2021 <a href="www.marketexchangefx.com" >MarketExchangeFX Ltd</a > All Rights Reserved. </p>
       ';

            if ($mail->send()) {
                sendLog("Deposit Confirmation! \n username:" . $username . "\n amount: " . $amount);
                redirect("../admin_dashboard.php?success=Deposit Confirmed");

            } else {
                redirect("../admin_dashboard.php?error=email not sent");
            }
            // echo 'Message has not been sent';
        } catch (Exception $e) {
            redirect("../admin_dashboard.php?error=mailer error");
        }

    } else {
        redirect("../admin_dashboard.php?error=Username Invalid!");
    }

}
;

if (isset($_POST["confirm_withdrawal"])) {
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $amount = $_POST["amount"];
    $username = $_POST["username"];
    $type = $_POST["type"];
    if (empty($username) || empty($amount) || empty($type)) {
        redirect("../admin_dashboard.php?error=Fill all fields!");
    }
    if (username_exists($username)) {

        $sql = "SELECT email,full_name FROM users WHERE  users.username =? LIMIT 1 ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        $email = $user->email;
        $fullName = $user->full_name;
        //  CREATE PAYMENT SLIP
        $sql = "INSERT INTO withdrawal_history (username,amount,type) VALUES (?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $amount, $type]);

//SEND EMAIL FOR VERIFICATION
        // Load Composer's autoloader
        require '../vendor/autoload.php';

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->SMTPSecure = "ssl"; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->Username = $_ENV['SMTP_USER'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->Port = $_ENV['SMTP_PORT'];
            $mail->isHTML(true); // Set email format to HTML

            //Recipients
            $mail->setFrom('noreply@marketexchangefx.com', 'MarketExchangeFX Ltd');
            $mail->addAddress($email, $fullName); // Add a recipient

            $mail->Subject = 'Withdrawal Confirmation';
            $mail->Body = '<p>Hello ' . $fullName . ',<br> Your withdrawal of <h3 style="display:inline">$' . $amount . '</ h3> have been confirmed.</p>
      <p> We look forward to a great partnership with you, Enjoy your journey of financial Freedom.  </p>
       <br>
       <p>Do you have any questions? Visit our <a href="www.marketexchangefx.com/faq.php" >FAQ</a > page. </p>
       <br>
       <p>If you did not attempt to make deposit, please ignore this email. </p>
       <br>
       <p>Thanks,</p>
       <p>MarketExchangeFX Ltd</p>
       <hr>
       <p>© 2021 <a href="www.marketexchangefx.com" >MarketExchangeFX Ltd</a > All Rights Reserved. </p>
       ';

            if ($mail->send()) {
                sendLog("Withdrawal Confirmation! \n username:" . $username . "\n amount: " . $amount);
                redirect("../admin_dashboard.php?success=Withdrawal Confirmed");

            } else {
                redirect("location:admin_dashboard.php?error=email not sent");
            }
            // echo 'Message has not been sent';
        } catch (Exception $e) {
            redirect("location:admin_dashboard.php?error=mailer error");
        }

    } else {
        redirect("location:admin_dashboard.php?error=Username Invalid!");
    }

}

if (isset($_POST["add_fund"])) {
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $amount = $_POST["amount"];
    $username = $_POST["username"];

    if (empty($username) || empty($amount)) {
        redirect("../admin_dashboard.php?error=Fill all fields!");
    }
    if (username_exists($username)) {

        $sql = "SELECT balance FROM users WHERE  users.username =? LIMIT 1 ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        $balance = $user->balance;
        $new_balance = $balance + $amount;
        $sql = "UPDATE users SET balance=? WHERE  users.username =?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$new_balance, $username]);
        redirect("../admin_dashboard.php?success=Funds Added,Update earnings history for user if this is a daily earnings update");
    } else {
        redirect("../admin_dashboard.php?error=Username Invalid!");
    }

}

if (isset($_POST["deduct_fund"])) {
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $amount = $_POST["amount"];
    $username = $_POST["username"];
    if (empty($username) || empty($amount)) {
        redirect("../admin_dashboard.php?error=Fill all fields!");
    }
    if (username_exists($username)) {

        $sql = "SELECT balance FROM users WHERE  users.username =? LIMIT 1 ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        $balance = $user->balance;
        $new_balance = $balance - $amount;
        $sql = "UPDATE users SET balance=? WHERE  users.username =?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$new_balance, $username]);
        redirect("../admin_dashboard.php?success=Funds deducted");
    } else {
        redirect("../admin_dashboard.php?error=Username Invalid!");
    }

}

if (isset($_POST["change_earnings"])) {

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $amount = $_POST["amount"];
    $username = $_POST["username"];
    if (empty($username) || empty($amount)) {
        header("location:../admin_dashboard.php?error=Fill all fields!");
    }
    if (username_exists($username)) {
        $sql = "UPDATE users SET earnings=? WHERE  users.username =?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$amount, $username]);
        header("location:../admin_dashboard.php?success=Earnings Updated");
    } else {
        header("location:../admin_dashboard.php?error=Username Invalid!");
    }

}
if (isset($_POST["update_earnings"])) {

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $amount = $_POST["amount"];
    $username = $_POST["username"];
    if (empty($username) || empty($amount)) {
        header("location:../admin_dashboard.php?error=Fill all fields!");
    }
    if (username_exists($username)) {
        $sql = "INSERT INTO daily_earnings(amount,username) VALUES(?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$amount, $username]);
        header("location:../admin_dashboard.php?success=Earnings History Updated for User");
    } else {
        header("location:../admin_dashboard.php?error=Username Invalid!");
    }

} else {
    redirect("../signup.php?error=accessforbidden");

}
;
