<?php

if (!isset($_GET["email"])) {
    header("location:index.php");
    exit();
}
require_once 'includes/functions.php';

?>
<?php
require_once 'includes/head.php';
// require_once 'includes/functions.php';
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
                        <h3>verify email</h3>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="bottom_body inner_page_body">

    	<section class="common_page">
            <div class="container">






<div class="row">







<form method="post" action="includes/verify_email.php"  class="register">
<input type="hidden" name="email" value="<?php if (isset($_GET["email"])) {
    echo $_GET["email"];
}
?>">
<h2 class="common_heading">Enter Verification code <small>*check spam folder if you don't see mail in inbox</small></h2>

<?php showErrorSuccess()?>
  <div class="col-sm-12 col-xs-12  col-md-6 col-md-offset-3">


  <div class="form_box">

       <span> <i aria-hidden="true" class="fa fa-key"></i>


<input  placeholder="enter code" required minLength="6" maxLength="6" type=text name="code" value="" class=inpts size=30></span>

</div></div>


  <div class="col-sm-12 text-center">

<input class="btn btn-primary" name="submit"  type="submit" value="submit" class=sbmt>

</div>




</form>

</div>
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
</html>

