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
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//  GEt USERS
$sql = "SELECT * FROM deposit_history ORDER BY deposit_history.date ";
$stmt = $pdo->prepare($sql);
$stmt->execute([]);
$confirmed_payments = $stmt->fetchAll();

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
     <?php
require_once 'includes/header3.php';
?>
 <?php
require_once 'includes/admin_menu.php';
?>
     <!--End sidebar-wrapper-->

  <!--Start topbar header-->

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

  <table style="color:white" cellspacing="1" cellpadding="1" border="0" width="100%">
  <tbody>
  <tr>
   <td class="inheader" ><b>username</b></td>
   <td class="inheader" ><b>type</b></td>
     <td class="inheader" ><b>Amount</b></td>
     <td class="inheader" ><b>date</b></td>
  </tr>
  <?php
if (count($confirmed_payments) > 0) {
    foreach ($confirmed_payments as $row) {
        $amt = $row->amount;
        $date = $row->date;
        $username = $row->username;
        $type = $row->type;
        echo '<tr>
         <td class="inheader">' . $username . '</td>
         <td class="inheader">' . $type . '</td>
         <td class="inheader">' . $amt . '</td>
         <td class="inheader">' . $date . '</td>

        </tr>';
    }
    ;
} else {
    echo '<tr>
        <td colspan="3" align="center">No DEposits found</td>
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






    </div><!--End wrapper-->




  </body></html>