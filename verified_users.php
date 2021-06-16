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
$sql = $query === "id" ? "SELECT *
                          FROM users WHERE users.verified=? AND users.blocked=?
                          ORDER BY users.id" : "SELECT *
                          FROM users WHERE users.verified=? AND users.blocked=? ORDER BY users.username";
$stmt = $pdo->prepare($sql);
$stmt->execute([true, false]);
$users = $stmt->fetchAll();

?>

<?php
if (isset($_POST["block"])) {
    $username = $_POST["username"];
    $sql = "UPDATE users SET blocked=?  WHERE users.username=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([true, $username]);
    header("location:verified_users.php?success=user blocked!");

}
;
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
     <a href="verified_users.php?q=alphebeticsort"><button class="btn btn-primary">sort  alphabetically</button></a><br>
  <a href="verified_users.php"><button class="btn btn-primary">sort by  time</button></a>
  <table cellspacing="1" cellpadding="1" border="0" width="100%">
  <tbody>
  <tr>
   <td class="inheader" ><b>username</b></td>
   <td class="inheader" ><b>name</b></td>
   <td class="inheader" ><b>phone</b></td>
   <td class="inheader" ><b>email</b></td>
   <td class="inheader" ><b>btc wallet</b></td>

   <td class="inheader" ><b>bch wallet</b></td>

  </tr>


  <?php
if (count($users) > 0) {
    foreach ($users as $row) {
        $username = $row->username;
        $fullname = $row->full_name;
        $phone = $row->phone;
        $email = $row->email;
        $btc = $row->bitcoin;
        $bch = $row->bitcash;

        echo '<tr>
         <td class="inheader">' . $username . '</td>
         <td class="inheader">' . $fullname . '</td>
         <td class="inheader">' . $phone . '</td>
         <td class="inheader">' . $email . '</td>
         <td class="inheader">' . $btc . '</td>

         <td class="inheader">' . $bch . '</td>

         <td class="inheader">
         <form method="POST" action="verified_users.php" onsubmit="return confirm(\'Are you sure you want to submit this form?\')">
         <input type="text" name="username" style="display:none" value="' . $username . '">
         <input class="btn btn-danger" type="submit" value="Block" name="block">
         </form>
         </td>
        </tr>';
    }
    ;
} else {
    echo '<tr>
        <td colspan="3" align="center">No Active users found</td>
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
    <!--Start Back To Top Button-->
      <a href="javaScript:void();" class="back-to-top">
          <i class="fa fa-angle-double-up"></i> </a>
      <!--End Back To Top Button-->

      <!--Start footer-->
      <footer class="footer">
        <div class="container">
          <div class="text-center">
            Copyright © 2020 CRYPTOFOREX FIRM GROUP All Rights Reserved
          </div>
        </div>
      </footer>
      <!--End footer-->



    </div><!--End wrapper-->
  </body></html>