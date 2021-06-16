<?php
include "includes/functions.php";
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
if (!isUserLoggedIn() || !isAdminLoggedIn()) {
    redirect("signup.php?error=accessforbidden");
}
;
?>
   <?php
require './includes/db.php';
$query = isset($_GET["q"]) ? $_GET["q"] : "id";
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$sql = "SELECT * FROM snackbar";
$stmt = $pdo->prepare($sql);
$stmt->execute([true, false]);
$snackbarUsers = $stmt->fetchAll();

?>

<?php
if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    $sql = "DELETE FROM snackbar WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    redirect("snackbar.php?success=user deleted!");

}
;
if (isset($_POST["add_user"])) {
    $username = $_POST["username"];
    $amount = $_POST["amount"];
    $sql = "INSERT INTO snackbar (username,amount) VALUES (?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $amount]);
    redirect("snackbar.php?success=user added!");
}
if (isset($_POST["add_user_withdrawal"])) {
    $username = $_POST["username"];
    $amount = $_POST["amount"];
    $sql = "INSERT INTO snackbar (username,amount,deposit) VALUES (?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $amount, false]);
    redirect("snackbar.php?success=user added!");
}
?>

<?php
require_once 'includes/head.php';
?>
  <body class="bg-theme bg-theme1  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
    <div class="pace-progress-inner"></div>
  </div>
  <div class="pace-activity"></div></div><div id="hl_site_verification" style="display: none;">085258</div>




  <!-- Start wrapper-->
   <div id="wrapper">

    <!--Start sidebar-wrapper-->
     <div id="sidebar-wrapper" data-simplebar="init" data-simplebar-auto-hide="true"><div class="simplebar-track vertical" style="visibility: hidden;">
     <div class="simplebar-scrollbar"></div></div><div class="simplebar-track horizontal" style="visibility: hidden;">
     <div class="simplebar-scrollbar"></div></div>

     <!--End sidebar-wrapper-->

  <!--Start topbar header-->
  <?php
require_once 'includes/header3.php';
?>
 <?php
require_once 'includes/admin_menu.php';
?>
  <!--End topbar header-->
  <div class="clearfix"></div>

    <div class="content-wrapper">
      <div class="container-fluid">

  <script language="javascript">
  function go(p)
  {
    document.opts.page.value = p;
    document.opts.submit();
  }
  </script>
  <div>

  </div>
  <?php
if (isset($_GET["error"])) {echo "<p style='color:red'>" . $_GET["error"] . "</p>";}
if (isset($_GET["success"])) {echo "<p style='color:green'>" . $_GET["success"] . "</p>";}
?>

<div class=" pl-2">
      <p>Add Deposit user:</p>
      <form method="POST" action = "snackbar.php" >
     <input type="text" placeholder="username"  required style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="username" ><br>
     <input type="text"placeholder="amount" required style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="amount" ><br>
   <input style="padding: 5px 10px;" type="submit" name="add_user" class="contact-btn" value="Add deposit">
      </form>
		</div> <br><br>
		<div class=" pl-2">
      <p>Add Withdrawal user:</p>
      <form method="POST" action = "snackbar.php" >
     <input type="text" placeholder="username"  required style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="username" ><br>
     <input type="text"placeholder="amount" required style="color: white;background: #daa52040;margin-bottom: 20px;    width: auto;" name="amount" ><br>
   <input style="padding: 5px 10px;" type="submit" name="add_user_withdrawal" class="contact-btn" value="Add withdrawal">
      </form>
		</div>
  <table cellspacing="1" cellpadding="1" border="0" width="100%">
  <tbody>
  <tr>
   <td class="inheader" ><b>username</b></td>
   <td class="inheader" ><b>amount</b></td>
   <td class="inheader" ><b>time</b></td>
   <td class="inheader" ><b>delete</b></td>
  </tr>


  <?php
if (count($snackbarUsers) > 0) {
    foreach ($snackbarUsers as $row) {
        $username = $row->username;
        $amount = $row->amount;
        $time = $row->time;
        $id = $row->id;

        echo '<tr>
         <td class="inheader">' . $username . '</td>
         <td class="inheader">' . $amount . '</td>
         <td class="inheader">' . $time . '</td>

         <td class="inheader">
         <form method="POST" action="snackbar.php" onsubmit="return confirm(\'Are you sure you want to submit this form?\')">
         <input type="text" name="id" style="display:none" value="' . $id . '">
         <input class="btn btn-danger" type="submit" value="delete" name="delete">
         </form>
         </td>
        </tr>';
    }
    ;
} else {
    echo '<tr>
        <td colspan="3" align="center">No snackbar users found</td>
       </tr>';
}
?>
</tbody></table>
  <style>
      .inheader{
      background: #33070ba3;
      line-height: 42px;
      text-align: left;
      padding:0 10px;
      border: 1px solid #4c080e;
      }

      .item{
      background: #2a0456;
      line-height: 42px;
      text-align: left;
      padding:0 20px;
      border: 1px solid #430988;
      }

      .contact-btn {
      background: #1ba8c6;
      border: 1px solid #1ba8c6;
      color: #fff;
      display: inline-block;
      font-size: 20px;
      margin-top: 5px;
      padding: 13px 40px;
      transition: 0.4s;
      border-radius: 3px;
      width: auto;
      float: left;
      text-transform: capitalize;
      font-weight: 600;
  }
      .contact-btn:hover {
      background:transparent;
      border: 1px solid #1ba8c6 ;
      color: #1ba8c6;
      transition: 0.4s;
  }
  </style>

  <!--start overlay-->
            <div class="overlay toggle-menu"></div>
          <!--end overlay-->

      </div>
      <!-- End container-fluid-->

      </div><!--End content-wrapper-->
      <?php
require_once 'includes/footer.php';
?>



    </div><!--End wrapper-->
  </body></html>