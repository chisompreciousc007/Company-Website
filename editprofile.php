<?php
require_once 'includes/head.php';
require_once 'includes/functions.php';
if (!isUserLoggedIn()) {
    redirect("signup.php?error=accessforbidden");
}
?>
<body>


    <wrapper>
    <?php
require_once 'includes/header2.php';
?>
            <section class="admin_body">
            <?php
require_once 'includes/admin_menu.php';
?>

                    <table style="margin: auto;">
                        <tbody>
                        <tr>
                                <td>
                                    <p style="color:#FFFFFF">Full Name:</p>
                                </td>
                                <form action="includes/edit_profile.php" method="post">
                                <input type="hidden"  name="username" value="<?php echo $_SESSION["Username"]; ?>" >
                                <td><input type="text" class="inpts" size="30" name="fullname" value=""
                                style="color: white;background: #daa52040;margin-bottom: 20px;" ></td>
                                <td><input type="submit" name="edit1" value="submit" class="sbmt"></td>
                                </form>
                            </tr>
                            <tr>
                                <td>
                                    <p style="color:#FFFFFF">Bitcoin Wallet:</p>
                                </td>
                                <form action="includes/edit_profile.php" method="post">
                                <input type="hidden"  name="username" value="<?php echo $_SESSION["Username"]; ?>" >
                                <td><input type="text" class="inpts" size="30" name="bitcoin" value=""
                                style="color: white;background: #daa52040;margin-bottom: 20px;" ></td>
                                <td><input type="submit" value="submit" name="edit2" class="sbmt"></td>
                                </form>
                            </tr>

                            <tr>
                                <td>
                                    <p style="color:#FFFFFF">Bitcoin Cash Wallet:</p>
                                </td>
                                <form action="includes/edit_profile.php" method="post">
                                <input type="hidden"  name="username" value="<?php echo $_SESSION["Username"]; ?>" >
                                <td><input type="text" class="inpts" size="30" name="bitcash" value=""
                                style="color: white;background: #daa52040;margin-bottom: 20px;"></td>
                                <td><input type="submit" value="submit" name="edit3" class="sbmt"></td>
                                </form>
                            </tr>
                            <tr>
                                <td>
                                    <p style="color:#FFFFFF">New Password:</p>
                                </td>
                                <form action="includes/edit_profile.php" method="post">
                                <input type="hidden"  name="username" value="<?php echo $_SESSION["Username"]; ?>" >
                                <td><input type="password" name="password" value="" class="inpts" size="10"
                                style="color: white;background: #daa52040;margin-bottom: 20px;"></td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="color:#FFFFFF">Retype Password:</p>
                                </td>
                                <td><input type="password" name="password2" value="" class="inpts" size="20"
                                style="color: white;background: #daa52040;margin-bottom: 20px;"></td>
                                <td><input type="submit" value="submit" name="edit4" class="sbmt"></td>
                                </form>
                            </tr>

                                                   </tbody>
                    </table>


                    <!------------------------------ end sidebar ------------------------------->
                    <div class="container" style="margin-top: 20px;margin-bottom: 20px;">

                    </div>

            </section>
        </header>
    </wrapper>
</body>

</html>