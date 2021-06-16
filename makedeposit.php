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
                <div style="display:none">
                </div>

                <!------------------------------ end sidebar ------------------------------->
                <div class="container" style="margin-top: 20px;margin-bottom: 20px;">

                    <form method="post" name="spendform" >
                                           <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                            <tbody>
                                <tr>
                                    <th colspan="3">
                                        <input type="radio" name="h_id" value="1" checked="" onclick="updateCompound()">
                                        <!--	<input type=radio name=h_id value='1'  checked  > -->

                                        <b>3.20% daily / Per Contract</b></th>
                                </tr>
                                <tr>
                                    <td class="inheader">Plan</td>
                                    <td class="inheader" width="200">Invest Amount</td>
                                    <td class="inheader" width="100" nowrap="">
                                        <nobr>Daily Profit (%)</nobr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="item">3.20% daily For 7 Days</td>
                                    <td class="item" align="right">100 USD - 4,999 USD</td>
                                    <td class="item" align="right">3.20</td>
                                </tr>
                            </tbody>
                        </table><br><br>
                        <script>
                            cps[1] = [];
                        </script>
                        <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                            <tbody>
                                <tr>
                                    <th colspan="3">
                                        <input type="radio" name="h_id" value="2" onclick="updateCompound()">
                                        <!--	<input type=radio name=h_id value='2'  > -->

                                        <b>4.50% daily / Per Contract</b></th>
                                </tr>
                                <tr>
                                    <td class="inheader">Plan</td>
                                    <td class="inheader" width="200">Invest Amount</td>
                                    <td class="inheader" width="100" nowrap="">
                                        <nobr>Daily Profit (%)</nobr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="item">4.50% daily For 7 Days</td>
                                    <td class="item" align="right">5,000 USD - 49,999 USD</td>
                                    <td class="item" align="right">4.50</td>
                                </tr>
                            </tbody>
                        </table><br><br>
                        <script>
                            cps[2] = [];
                        </script>
                        <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                            <tbody>
                                <tr>
                                    <th colspan="3">
                                        <input type="radio" name="h_id" value="3" onclick="updateCompound()">
                                        <!--	<input type=radio name=h_id value='3'  > -->

                                        <b>149.80% after / Per Contract</b></th>
                                </tr>
                                <tr>
                                    <td class="inheader">Plan</td>
                                    <td class="inheader" width="200">Invest Amount</td>
                                    <td class="inheader" width="100" nowrap="">
                                        <nobr> Profit (%)</nobr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="item">149.80% after 30 Days</td>
                                    <td class="item" align="right">5,000 USD - 100,000 USD</td>
                                    <td class="item" align="right">149.80</td>
                                </tr>
                            </tbody>
                        </table><br><br>
                        <script>
                            cps[3] = [];
                        </script>

                        <table cellspacing="0" cellpadding="2" border="0" class="blank">
                            <tbody>
                                <tr>
                                    <td>Your account balance ($):</td>
                                    <td align="right"> <?php echo $balance; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td align="right">
                                        <small>
                                        </small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <h4 style="color: white;">Send Your Investment amount to the wallet below to buy HashPower</h4> <br>
                    <div style="padding: 5px;border: solid 1px;color:white;">


 <p>BITCOIN WALLET ADDRESS</p>
 <input style="background: transparent;width: 303px;color: white;" type="text" value="<bitcoin address here>" id="myInput"  >
 <input type="button" onclick="myFunction()" value="Copy" class="sbmt" style="background: darkgoldenrod;">
  <script>
 function myFunction() {
 /* Get the text field */
 var copyText = document.getElementById("myInput");

 /* Select the text field */
 copyText.select();
 copyText.setSelectionRange(0, 99999); /* For mobile devices */

 /* Copy the text inside the text field */
 document.execCommand("copy");

 /* Alert the copied text */
 alert("Copied address: " + copyText.value);
}

 </script>

 </div> <br> <br>
 <div style="padding: 5px;border: solid 1px;color:white;">

<p>BITCOIN-CASH WALLET ADDRESS</p>
<input style="background: transparent;width: 350px;color: white;" type="text" value="<bitcash address here>" id="myInput2"  >
<input type="button" onclick="myFunction2()" value="Copy" class="sbmt" style="background: darkgoldenrod;">
 <script>
function myFunction2() {
/* Get the text field */
var copyText = document.getElementById("myInput2");

/* Select the text field */
copyText.select();
copyText.setSelectionRange(0, 99999); /* For mobile devices */

/* Copy the text inside the text field */
document.execCommand("copy");

/* Alert the copied text */
alert("Copied address: " + copyText.value);
}

</script>

</div>

                    <script language="javascript">
                        for (i = 0; i < document.spendform.type.length; i++) {
                            if ((document.spendform.type[i].value.match(/^process_/))) {
                                document.spendform.type[i].checked = true;
                                break;
                            }
                        }
                        updateCompound();
                    </script>












                </div>

            </section>
            <?php
require_once 'includes/secure_section.php';
?>
            <?php
require_once 'includes/footer.php';
?>  </header>
    </wrapper>
</body>

</html>
