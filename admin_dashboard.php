<?php
include "includes/functions.php";
require_once 'includes/head.php';
if (!isUserLoggedIn() || !isAdminLoggedIn()) {
    redirect("signup.php?error=accessforbidden");
}
;
get_users_online();
?>

<?php
require_once 'includes/db.php';
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//  GEt USERS
$sql = "SELECT username,verified,blocked FROM users ";
$stmt = $pdo->prepare($sql);
$stmt->execute([]);
$users = $stmt->fetchAll();

function user_is_verified($user)
{
    if ($user->verified && !$user->blocked) {
        return true;
    } else {
        return false;
    }

}
function user_is_unverified($user)
{
    if (!$user->verified && !$user->blocked) {
        return true;
    } else {
        return false;
    }

}
function user_is_blocked($user)
{
    if ($user->blocked) {
        return true;
    } else {
        return false;
    }

}

$verified_users_count = count((array_filter($users, "user_is_verified")));
$unverified_users_count = count((array_filter($users, "user_is_unverified")));
$blocked_users_count = count((array_filter($users, "user_is_blocked")));

//  GEt DEPOSIT HISTORY
$sql = "SELECT amount FROM deposit_history ";
$stmt = $pdo->prepare($sql);
$stmt->execute([]);
$deposits = $stmt->fetchAll();
$deposits_amt_array = [];
foreach ($deposits as $deposit) {
    $deposits_amt_array[] = $deposit->amount;
}
$deposits_total_amount = array_sum($deposits_amt_array);
?>



<body class="bg-theme bg-theme1  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
<!-- Start wrapper-->
 <div id="wrapper">

     <?php
require_once 'includes/header3.php';
?>
        <?php
require_once 'includes/admin_menu.php';
?>

<!--Start topbar header-->

<!--End topbar header-->

<div class="clearfix"></div>

  <div class="content-wrapper">
    <div class="container-fluid" style="color: white;">

    <?php
if (isset($_GET["error"])) {echo "<p style='color:red'>" . $_GET["error"] . "</p>";}
if (isset($_GET["success"])) {echo "<p style='color:green'>" . $_GET["success"] . "</p>";}
?>
<!--Start Dashboard Content-->

	<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">

                <div class="card-body">
                <span>Users Online</span>  <h5 class="text-white mb-0"> <?php echo $_SESSION["users_online"];
?></h5>
      <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>

                    <span>Verified Users</span>  <h5 class="text-white mb-0"> <?php echo $verified_users_count;
?><span class="float-right"><a href="./verified_users.php">view</a></span></h5>
      <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>

                    <span>Blocked users</span>  <h5 class="text-white mb-0"> <?php echo $blocked_users_count
?><span class="float-right"><a href="./blocked_users.php">view</a></span></h5>
      <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>

                    <span>Non-Verified Users</span>  <h5 class="text-white mb-0"> <?php echo $unverified_users_count;
?><span class="float-right"><a href="./non_verified_users.php">view</a></span></h5>
      <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>


                    <span>Total Deposits</span>  <h5 class="text-white mb-0"> N<?php echo $deposits_total_amount;
?><span class="float-right"><a href="./deposit_history.php">view</a></span></h5>
      <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>

                    <span>snackBar</span>  <h5 class="text-white mb-0">
                    <span class="float-right"><a href="./snackbar.php">view</a></span></h5>
      <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>


        </div>
    </div>
 </div>

	<div class="row">
     <div class="col-12 col-lg-8 col-xl-8">
	    <div class=" pl-2">
            <p>Confirm Deposit/Email Notification:</p>
            <?php
if (isset($_GET["error"])) {echo "<p style='color:red'>" . $_GET["error"] . "</p>";}
if (isset($_GET["success"])) {echo "<p style='color:green'>" . $_GET["success"] . "</p>";}
?>
            <form method="POST" action = "includes/admin_dashboard.php" >
          <input type="text" placeholder="username"  style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="username" ><br>
          <input type="text"placeholder="amount"  style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="amount" ><br>
          <input type="text"placeholder="bitcoin/bitcash"  style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="type" ><br>
            <input style="padding: 5px 10px;" type="submit" name="confirm_deposit" class="contact-btn" value="Confirm">
            </form>
		  </div>
   </div>
   <div class="col-12 col-lg-8 col-xl-8">
	    <div class=" pl-2">
      <p>Confirm Withdrawal/Email Notification:</p>
      <?php
if (isset($_GET["error"])) {echo "<p style='color:red'>" . $_GET["error"] . "</p>";}
if (isset($_GET["success"])) {echo "<p style='color:green'>" . $_GET["success"] . "</p>";}
?>
      <form method="POST" action = "includes/admin_dashboard.php" >
     <input type="text" placeholder="username"  style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="username" ><br>
     <input type="text"placeholder="amount"  style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="amount" ><br>
     <input type="text"placeholder="bitcoin/bitcash"  style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="type" ><br>
   <input style="padding: 5px 10px;" type="submit" name="confirm_withdrawal" class="contact-btn" value="Confirm">
      </form>
		</div>
	 </div>

   <div class="col-12 col-lg-8 col-xl-8">
	    <div class=" pl-2">
      <p>Add Funds to User:</p>
      <form method="POST" action = "includes/admin_dashboard.php" >
     <input type="text" placeholder="username"  style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="username" ><br>
     <input type="text"placeholder="amount"  style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="amount" ><br>
   <input style="padding: 5px 10px;" type="submit" name="add_fund" class="contact-btn" value="Add Fund">
      </form>
		</div>
	 </div>

   <div class="col-12 col-lg-8 col-xl-8">
	    <div class=" pl-2">
      <p>Deduct Funds From User:</p>
      <form method="POST" action = "includes/admin_dashboard.php" >
     <input type="text" placeholder="username"  style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="username" ><br>
     <input type="text"placeholder="amount"  style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="amount" ><br>
   <input style="padding: 5px 10px;" type="submit" name="deduct_fund" class="contact-btn" value="Deduct Fund">
      </form>
		</div>
	 </div>
     <div class="col-12 col-lg-8 col-xl-8">
	    <div class=" pl-2">
      <p>Set Daily Earnings:</p>
      <form method="POST" action = "includes/admin_dashboard.php" >
     <input type="text" placeholder="username" style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="username" ><br>
     <input type="text"placeholder="amount" style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="amount" ><br>
   <input style="padding: 5px 10px;" type="submit" name="change_earnings" class="contact-btn" value="Set Earning">
      </form>
		</div>
	 </div>
	  <div class="col-12 col-lg-8 col-xl-8">
	    <div class=" pl-2">
      <p>update Daily Earnings history for user:</p>
      <form method="POST" action = "includes/admin_dashboard.php" >
     <input type="text" placeholder="username" style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="username" ><br>
     <input type="text"placeholder="amount" style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="amount" ><br>
   <input style="padding: 5px 10px;" type="submit" name="update_earnings" class="contact-btn" value="Update Earning History">
      </form>
		</div>
	 </div>
	</div><!--End Row-->



      <!--End Dashboard Content-->


<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

    </div>
    <!-- End container-fluid-->

    </div><!--End content-wrapper-->


  </div><!--End wrapper-->



<?php
require_once 'includes/footer.php';
?>


</body></html>