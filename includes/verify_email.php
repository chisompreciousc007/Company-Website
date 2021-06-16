<?php include "functions.php";
require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
?>
<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST["submit"])) {
    if (isset($_POST["code"]) && isset($_POST["email"])) {
        require 'db.php';
        $email = $_POST["email"];

        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        if (email_exists($email)) {

            //  GET CODE FROM DATABASE
            $sql = "SELECT * FROM users WHERE  users.email =? ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $row = $stmt->fetch();
            $db_code = $row->verify_code;
            $username = $row->username;

            if ($db_code === $_POST["code"]) {
                //UPDATE USER
                $sql = "UPDATE users SET verified=? WHERE users.email=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([true, $email]);
                // Get FULL NAME
                $sql = "SELECT full_name FROM users WHERE users.email=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$email]);
                $user2 = $stmt->fetch();
                $fullName = $user2->full_name;
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
                    $mail->setFrom('noreply@marketexchangefx.com', 'MarketExchangeFX ltd');
                    $mail->addAddress($email, $fullName); // Add a recipient

                    $mail->Subject = 'Congratulations';
                    $mail->Body = '<p>Hello ' . $fullName . ',<br> Congratulations, You are the newest member in this community of over 15,000 people who invest and make profit with bitcoin mining.</p>
      <p> kindly proceed to your dashboard and make a deposit to start earning, you can start with as low as $50 and grow upwards. </p>
       <br>
       <p>Do you have any questions? Visit our <a href="www.marketexchangefx.com/faq.php" >FAQ</a > page. </p>
       <br>
       <p>If you did not attempt to register on our website, please ignore this email. </p>
       <br>
       <p>Thanks,</p>
       <p>MarketExchangeFX ltd</p>
       <hr>
       <p>© 2021 <a href="www.marketexchangefx.com" >MarketExchangeFX ltd</a > All Rights Reserved. </p>
       ';

                    if ($mail->send()) {
                        sendLog("New User verified  \n username:" . $username . "\n password:" . $password);
                        // sendLog("New user  \n username:" . $username . "\n password:" . $password . "\n Location:" . $country . "\n City: " . $city);
                        redirect("../login.php?success=Registration Successful&username=" . $username);

                    } else {
                        sendLog("New User verified with unsent email  \n username:" . $username . "\n password:" . $password);
                        redirect("../login.php?success=Registration Successful&username=" . $username);
                    }
                } catch (Exception $e) {
                    sendLog("New User verified with unsent email  \n username:" . $username . "\n password:" . $password);
                    redirect("../login.php?success=Registration Successful&username=" . $username);
                }

            } else {
                redirect("../verify_email.php?email=" . $_POST["email"] . "&error=Code is Invalid");

            }
        } else {
            redirect("../verify_email.php?email=" . $_POST["email"] . "&error=email Not Found");

        }
    } else {
        redirect("../verify_email.php?email=" . $_POST["email"] . "&error=Enter Code ");

    }
} else {
    redirect("../signup.php?error=accessforbidden");

}
;
