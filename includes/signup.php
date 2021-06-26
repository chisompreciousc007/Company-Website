<?php
include "functions.php";
require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
?>
<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST["submit"])) {
    require 'db.php';
    $checkbot = $_POST["nemesis"];
    $fullName = strtolower($_POST["fullname"]);
    $email = strtolower($_POST["email"]);
    $username = strtolower($_POST["username"]);
    $password = $_POST["password"];
    $confirmPass = $_POST["password2"];
    $bitcoin = $_POST["bitcoin"];
    $bitcash = $_POST["bitcash"];
    $phone = strtolower($_POST["phone"]);
    $ref = strtolower($_POST["ref"]);
    if (!empty($checkbot)) {
        redirect("../signup.php?error=Cannot submit form&");
    }
    $userData = "fullname=" . $fullName . "&email=" . $email . "&username=" . $username . "&bitcoin=" . $bitcoin . "&bitcash=" . $bitcash . "&ref=" . $ref . "&phone=" . $phone;
    if (empty($fullName) || empty($email) || empty($username) || empty($password) || empty($confirmPass) || empty($phone)) {
        redirect("../signup.php?error=fill all fields with asterisk(*)&" . $userData);
    }
    if (!preg_match("/^[a-zA-Z0-9]*/", $username)) {
        redirect("../signup.php?error=invalid Username&" . $userData);
    }
    if ($password !== $confirmPass) {
        redirect("../signup.php?error=Password do not match&" . $userData);
    }
    if (username_exists($username)) {
        redirect("../signup.php?error=Username not available!&" . $userData);
    }
    if (email_exists($email)) {
        redirect("../signup.php?error=Email not available!&" . $userData);
    }
    if (phone_exists($phone)) {
        redirect("../signup.php?error=Phone number exists&" . $userData);
    }
    $verify_code = mt_rand(100000, 999999);

    //  POPULATE WALLET ADDRESSES
    $bitcoin = empty($bitcoin) ? null : $bitcoin;
    $bitcash = empty($bitcash) ? null : $bitcash;
    $ref = empty($ref) ? null : $ref;
    //  insert Data
    $sql = "INSERT INTO users (full_name,username,email,password,bitcoin,bitcash,phone,ref,verify_code) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->execute([$fullName, $username, $email, $hashedPassword, $bitcoin, $bitcash, $phone, $ref, $verify_code]);
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
        $mail->setFrom('noreply@codeplugx.com', 'This is a test');
        $mail->addAddress($email, $fullName); // Add a recipient

        $mail->Subject = 'Verification Code';
        $mail->Body = '<p>Hello ' . $fullName . ',<br> Welcome to our website.Please confirm your email with the verification Code.</p>
      <p> Your verification code is <h3 style="display:inline">' . $verify_code . '</h3> </p>
       <br>
       <p>Do you have any questions? Visit our <a href="www.google.com" >FAQ</a > page. </p>
       <br>
       <p>If you did not attempt to register on our website, please ignore this email. </p>
       <br>
       <p>Thanks,</p>
       <p>Your website here</p>
       <hr>
       <p>© 2021 <a href="www.codeplugx.com" >Your Website here</a > All Rights Reserved. </p>
       ';

        if ($mail->send()) {
            redirect("../verify_email.php?email=" . $email);

        } else {
            // echo "not sent";
            // DELETE USER
            $sql = "DELETE FROM users WHERE  users.email =?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            redirect("../signup.php?error=Verification code was not sent&" . $userData);
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // DELETE USER
        $sql = "DELETE FROM users WHERE  users.email =?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        redirect("../signup.php?error=Mailer failed&" . $userData);
    }
} else {
    redirect("../signup.php?error=access forbidden");
}
