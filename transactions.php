<?php
require_once 'includes/head.php';
require_once 'includes/functions.php';
if (!isUserLoggedIn()) {
    redirect("signup.php?error=accessforbidden");
}
require 'includes/db.php';
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$username = $_SESSION["Username"];
//  GEt WITHDRAWAL
$sql = "SELECT * FROM withdrawal_history WHERE username =? ORDER BY withdrawal_history.date";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$withdrawal_arr = $stmt->fetchAll();
$withdrawal_arr_length = $stmt->rowCount();
$withdrawal_amt_arr = [];
//  GEt DEPOSIT
$sql = "SELECT * FROM deposit_history WHERE username =? ORDER BY deposit_history.date";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$deposit_arr = $stmt->fetchAll();
$deposit_arr_length = $stmt->rowCount();
$deposit_amt_arr = [];
//  GEt Daily earnings
$sql = "SELECT * FROM daily_earnings WHERE username =? ORDER BY daily_earnings.date ";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$daily_earnings_arr = $stmt->fetchAll();
$daily_earnings_length = $stmt->rowCount();
$daily_earnings_amt_arr = [];
?>
<body>


    <wrapper>
    <?php
require_once 'includes/header3.php';
?>
            <section class="admin_body">
               p<?php
require_once 'includes/admin_menu.php';
?>
                <!------------------------------ end sidebar ------------------------------->
                <div class="container" style="margin-top: 20px;margin-bottom: 20px;">

                    <script language="javascript">
                        function go(p) {
                            document.opts.page.value = p;
                            document.opts.submit();
                        }
                    </script>

<table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">

<tbody>
<tr>
        <td class="inheader" colspan="2"><b>Daily Earnings</b></td>
    </tr>
    <tr>
        <td class="inheader" width="200"><b>Amount</b></td>
        <td class="inheader" width="170"><b>Date</b></td>
    </tr>
    <?php if ($daily_earnings_length > 0): ?>
        <?php foreach ($daily_earnings_arr as $row) {
    global $daily_earnings_amt_arr;
    $daily_earnings_amt_arr[] = $row->amount;
    echo '
        <tr>
        <td align="left">$' . $row->amount . '</td>
        <td align="left">' . $row->date . '</td>
    </tr>
        ';
}?>
    <tr>
        <td colspan="1">Total:</td>
        <td align="right"><b>$ <?php echo array_sum($daily_earnings_amt_arr); ?></b></td>
    </tr>
    <?php else: ?>
    <tr>
        <td colspan="3" align="center">No transactions found</td>
    </tr>

    <?php endif;?>


</tbody>
</table>
<br>



                    <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">

                        <tbody>
                        <tr>
                                <td class="inheader" colspan="3"><b>Withdrawal</b></td>
                            </tr>
                            <tr>
                                <td class="inheader"><b>Wallet</b></td>
                                <td class="inheader" width="200"><b>Amount</b></td>
                                <td class="inheader" width="170"><b>Date</b></td>
                            </tr>
                            <?php if ($withdrawal_arr_length > 0): ?>
                                <?php foreach ($withdrawal_arr as $row) {
    global $withdrawal_amt_arr;
    $withdrawal_amt_arr[] = $row->amount;
    echo '
                                <tr>
                                <td align="left">' . $row->type . '</td>
                                <td align="left">$' . $row->amount . '</td>
                                <td align="left">' . $row->date . '</td>
                            </tr>
                                ';
}?>
                            <tr>
                                <td colspan="2">Total:</td>
                                <td align="right"><b>$ <?php echo array_sum($withdrawal_amt_arr); ?></b></td>
                            </tr>
                            <?php else: ?>
                            <tr>
                                <td colspan="3" align="center">No transactions found</td>
                            </tr>

                            <?php endif;?>


                        </tbody>
                    </table>
                     <br>
                     <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">

<tbody>
<tr>
        <td class="inheader" colspan="3"><b>Deposit</b></td>
    </tr>
    <tr>
        <td class="inheader"><b>Wallet</b></td>
        <td class="inheader" width="200"><b>Amount</b></td>
        <td class="inheader" width="170"><b>Date</b></td>
    </tr>
    <?php if ($deposit_arr_length > 0): ?>
        <?php foreach ($deposit_arr as $row) {
    global $deposit_amt_arr;
    $deposit_amt_arr[] = $row->amount;
    echo '
        <tr>
        <td align="left">' . $row->type . '</td>
        <td align="left">$' . $row->amount . '</td>
        <td align="left">' . $row->date . '</td>
    </tr>
        ';
}?>
    <tr>
        <td colspan="2">Total:</td>
        <td align="right"><b>$ <?php echo array_sum($deposit_amt_arr); ?></b></td>
    </tr>
    <?php else: ?>
    <tr>
        <td colspan="3" align="center">No transactions found</td>
    </tr>

    <?php endif;?>


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
