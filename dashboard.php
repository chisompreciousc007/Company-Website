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
$sql = "SELECT balance,contract_amount FROM users WHERE username =? LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch();
$balance = $user->balance;
$contract_amount = $user->contract_amount;
//  GEt DEPOSIT
$sql = "SELECT * FROM admin WHERE id =? LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([4]);
$admin = $stmt->fetch();
$adm_balance = $admin->balance;
$daily_earning = $admin->day_earned;
$admin_balance = $adm_balance + $daily_earning;
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
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="admin_head_left">
                                <h4>Hello, <?php echo $_SESSION["Username"]; ?>

                                    <span>Your referral link: <b Style="text-transform:lowercase">www.yourwebsite.com/signup.php?ref=<?php echo $_SESSION["Username"]; ?></b> </span>
                                </h4>
                            </div>
                        </div>

                    </div>
                    <!------------------------------ end sidebar ------------------------------->

                    <div class="currency_hashrate">
                        <div class="container">
                            <h2 class="common_heading">Your account</h2>
                            <div class="row" style="width:80%;margin-left:auto;margin-right:auto;">
                                <div class="col-sm-6">
                                    <div class="summary_box">
                                        <h3>Miner Real Time</h3>
                                        <h4>Ƀ<b id="total_balance"><?php echo $daily_earning; ?></b></h4>
                                        <!------------------------------ multi balance ------
                                  <small>
                                                                                           </small>
                               end multi balance ------------->
                                        <span>Account Balance: Ƀ<b><?php echo $admin_balance; ?></b> &nbsp;</span>
                                        <!-- <h4><span>Earned Total: Ƀ<b id="total_profit">0.00000000</b></span>
                                        </h4> -->
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="summary_box">
                                        <h3>Active Contracts</h3>
                                        <h4>$<b><?php echo $contract_amount; ?></b><span>Available Balance: $<b><?php echo $balance; ?></b></span>
                                        </h4>
                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>
                </div>
                <div class="hash_power_content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="hashpower_left">

                                    <h2>Deposit<span>Buy HashPower Now</span></h2>
                                    <a class="btn btn-white" href="makedeposit.php">Click Here</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="hashpower_right">

                                    <h2>Withdraw<span>Request Your Mining Profit</span></h2>
                                    <a class="btn btn-primary" href="withdraws.php">Click Here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <script>
                    countEarnings();
                </script>




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