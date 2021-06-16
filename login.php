<?php
require_once 'includes/head.php';
require_once 'includes/functions.php';
?>
<body>


<wrapper>
<?php
require_once 'includes/header2.php';
?>
 <section class="inner_page_heading">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="main_title">
                        <h3>Login</h3>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="bottom_body inner_page_body">

    	<section class="common_page">
            <div class="container">




            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

<form method="post" action="includes/login.php" name=mainform >


 <h2 class="common_heading">Login</h2>


   <div class="col-sm-12 col-xs-12">  <div class="form_box form_box_login"><?php showErrorSuccess()?>


 <span><i class="fa fa-user"></i><input placeholder="Username"  type=text name=username value="<?php if (isset($_GET["username"])) {
    echo $_GET["username"];
}
?>" class=inpts size=30></span>

 </div></div>


    <div class="col-sm-12 col-xs-12">  <div class="form_box form_box_login">


 <span><i class="fa fa-key"> </i><input placeholder="Password" type=password name=password value='' class=inpts size=30></span>


 </div></div>





  <div class="col-sm-12 col-xs-12">
                                    <div class="form_box">
                                        <b>


<input class="btn btn-primary"  type=submit name="submit" value="Login" class=sbmt>

</b>
                                    </div>
                                </div>


</form>



  <div class="col-sm-12 col-xs-12 text-center">  <div class="fp">

<a href="forgotpassword.php">forgot password?</a>

</div></div>
</div></div></div></div>
  </section>



       </div>
        </section>



  <section class="secure">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="owl-carousel secure_carousel">
                        <div class="item">
                            <div class="secure_inner">
                                <img src="images/secure_icon_1.png" alt="secure_icon" class="img-responsive" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="secure_inner">
                                <img src="images/secure_icon_2.png" alt="secure_icon" class="img-responsive" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="secure_inner">
                                <img src="images/secure_icon_3.png" alt="secure_icon" class="img-responsive" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="secure_inner">
                                <img src="images/secure_icon_4.png" alt="secure_icon" class="img-responsive" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="secure_inner">
                                <img src="images/secure_icon_5.png" alt="secure_icon" class="img-responsive" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="secure_inner">
                                <img src="images/secure_icon_6.png" alt="secure_icon" class="img-responsive" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="secure_inner">
                                <img src="images/secure_icon_1.png" alt="secure_icon" class="img-responsive" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="secure_inner">
                                <img src="images/secure_icon_2.png" alt="secure_icon" class="img-responsive" />
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

       </div>
       <?php
require_once 'includes/footer.php';
?>
</wrapper>


</body>








<!-- Mirrored from teslamining.ltd/?a=login by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 May 2020 13:39:21 GMT -->
</html>

