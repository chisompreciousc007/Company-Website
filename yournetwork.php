<?php
require_once 'includes/head.php';
require_once 'includes/functions.php';
if (!isUserLoggedIn()) {
    redirect("signup.php?error=accessforbidden");
}
require 'includes/db.php';
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$username = $_SESSION["Username"];
//  GEt REFERRALS
$sql = "SELECT username,contract_amount FROM users WHERE ref =? ";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$referrals_arr = $stmt->fetchAll();
$referrals_arr_length = $stmt->rowCount();
$referrals_amt_arr = [];
foreach ($referrals_arr as $row) {
    global $referrals_amt_arr;
    $referrals_amt_arr[] = $row->contract_amount;
}
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

                    <table width="300" cellspacing="1" cellpadding="1" class="tab">
                        <tbody>
                            <tr>
                                <td class="item">Referrals:</td>
                                <td class="item"><?php echo $referrals_arr_length; ?> Users</td>
                            </tr>
                            <?php if ($referrals_arr_length > 0): ?>
                                <?php foreach ($referrals_arr as $row) {
    echo '
                                <tr>
                                <td align="left">' . $row->username . '</td>
                                <td align="left">$' . $row->contract_amount * 0.05 . '</td>
                            </tr>
                                ';
}?><?php endif;?>
                            <tr>
                                <td class="item">Total referral commission:</td>
                                <td class="item">$<?php echo array_sum($referrals_amt_arr) * 0.05; ?></td>
                            </tr>
                        </tbody>
                    </table>

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