<?php
require_once 'includes/head.php';
require_once 'includes/functions.php';
require_once 'includes/db.php';
if (!isUserLoggedIn()) {
    redirect("signup.php?error=accessforbidden");
}
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$username = $_SESSION["Username"];
//  GEt USER INFO
$sql = "SELECT balance FROM users WHERE users.username =? LIMIT 1 ";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch();
$balance = $user->balance;
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

                <!------------------------------ end sidebar ------------------------------->
                <div class="container" style="margin-top: 20px;margin-bottom: 20px;">




                        <table cellspacing="0" cellpadding="2" border="0" class="tab">
                            <tbody>
                                <tr>
                                    <td>Account Balance:</td>
                                    <td>$<b><?php echo $balance; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Pending Withdrawals: </td>
                                    <td>$<b>0</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php if ($balance > 120): ?>

                    <form method="post" action="includes/withdraws.php">
                    <input type="hidden" name="balance" value="<?php echo $balance; ?>">
                    <input type="hidden" name="username" value="<?php echo $_SESSION["Username"]; ?>">
                        <table cellspacing="0" cellpadding="2" border="0" class="tab">
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th>Select Wallet</th>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="radio" id="btc" name="wallet" checked value="btc">Bitcoin
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="radio" id="bch" name="wallet" value="bch">Bitcoin-Cash</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="number" name="amount" style="width: auto;color: black;" placeholder="Enter Amount" ></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                    <?php showErrorSuccess();?>
                                    <input type="submit" name="submit"  value="Submit" class="sbmt" ></td>
                                </tr>

                            </tbody>
                        </table>
                    </form>
                    <?php else: ?>
                    <br>
                    <p style="color:#FFFFFF">You have no funds to withdraw.</p>

                    <?php endif;?>
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
