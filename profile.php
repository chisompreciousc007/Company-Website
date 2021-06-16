<?php
require_once 'includes/head.php';
require_once 'includes/functions.php';
if (!isUserLoggedIn()) {
    redirect("signup.php?error=accessforbidden");
}
require_once 'includes/db.php';
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$username = $_SESSION["Username"];
//  GEt USER INFO
$sql = "SELECT * FROM users WHERE users.username =? LIMIT 1 ";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch();
$full_name = $user->full_name;
$email = $user->email;
$bitcoin = $user->bitcoin;
$bitcash = $user->bitcash;
$phone = $user->phone;
$reg_date = $user->reg_date;
?>
<body>


    <wrapper>
    <?php
require_once 'includes/header3.php';
?>
            <section class="admin_body">
            <?php
require_once 'includes/admin_menu.php';
?>
<br> <br>
<?php showErrorSuccess();?>
                    <table style="margin: auto;">
                        <tbody>
                        <tr>
                                <td>
                                    <p style="color:#FFFFFF">Full Name:</p>
                                </td>
                                <td>
                                <p style="color:#FFFFFF"><?php echo $full_name; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="color:#FFFFFF">Username:</p>
                                </td>
                                <td>
                                    <p style="color:#FFFFFF"><?php echo $username ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="color:#FFFFFF">joined:</p>
                                </td>
                                <td>
                                    <p style="color:#FFFFFF"><?php echo $reg_date ?></p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <p style="color:#FFFFFF">Bitcoin Wallet:</p>
                                </td>
                                <td><p style="color:#FFFFFF"><?php echo $bitcoin ?></p></td>
                            </tr>

                            <tr>
                                <td>
                                    <p style="color:#FFFFFF">Bitcoin Cash Wallet:</p>
                                </td>
                                <td><p style="color:#FFFFFF"><?php echo $bitcash ?></p></td>
                            </tr>

                            <tr>
                                <td>
                                    <p style="color:#FFFFFF">E-mail:</p>
                                </td>
                                <td><p style="color:#FFFFFF"><?php echo $email ?></p></td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="color:#FFFFFF">Phone:</p>
                                </td>
                                <td><p style="color:#FFFFFF"><?php echo $phone ?></p></td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td> <a href="editprofile.php"><input type="button" value="Change Account data" class="sbmt"></a> </td>
                            </tr>
                        </tbody>
                    </table>


                    <!------------------------------ end sidebar ------------------------------->
                    <div class="container" style="margin-top: 20px;margin-bottom: 20px;">

                    </div>

            </section>
            <?php
require_once 'includes/secure_section.php';
?>
            <?php
require_once 'includes/footer.php';
?>
        </header>
    </wrapper>
</body>

</html>