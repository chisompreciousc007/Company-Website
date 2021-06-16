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
                        <h3>Registration</h3>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="bottom_body inner_page_body">

    	<section class="common_page">
            <div class="container">


 <h2 class="common_heading">Signup and get instant access</h2>
 <?php showErrorSuccess();?>


   <div class="register_form_inner clearfix">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="row">

<form method="post" action="includes/signup.php" >
<input type="hidden" required name="ref" value="<?php if (isset($_GET["ref"])) {
    echo $_GET["ref"];
}
?>">







  <div class="col-sm-12 col-xs-12">
      <div class="form_box" style="width: 340px;">
      <input placeholder="Your Full name" style="display:none"  type=text name="nemesis" >
<label for="fullname">Full name</label>
       <span><i class="fa fa-user" aria-hidden="true"></i>
            <input placeholder="Your Full name" required  type=text name="fullname" value="<?php if (isset($_GET["fullname"])) {
    echo $_GET["fullname"];
}
?>" class=inpts size=30>
       </span>

     </div>
   </div>





  <div class="col-sm-12 col-xs-12">
      <div class="form_box" style="width: 340px;">
      <label for="fullname">Username</label>
       <span><i class="fa fa-user" aria-hidden="true"></i>
            <input placeholder="Username" required  type=text name="username" value="<?php if (isset($_GET["username"])) {
    echo $_GET["username"];
}
?>" class=inpts size=30>
       </span>

     </div>
   </div>




     <div class="col-sm-12 col-xs-12">
      <div class="form_box" style="width: 340px;">
      <label for="fullname">Email</label>
       <span><i class="fa fa-envelope"></i>
            <input placeholder="Your E-mail Address" required  type=text name="email" value="<?php if (isset($_GET["email"])) {
    echo $_GET["email"];
}
?>" class=inpts size=30>
       </span>

     </div>
   </div>

     <div class="col-sm-12 col-xs-12">
      <div class="form_box" style="width: 340px;">
      <label for="fullname">Password</label>
       <span><i class="fa fa-unlock-alt" aria-hidden="true"></i>
            <input placeholder="Password" required  type=password name="password" value="" class=inpts size=30>
       </span>

     </div>
   </div>



  <div class="col-sm-12 col-xs-12">
      <div class="form_box" style="width: 340px;">
      <label for="fullname">Confirm Password</label>
       <span><i class="fa fa-unlock-alt" aria-hidden="true"></i>
            <input placeholder="Confirm Password" required  type=password name="password2" value="" class=inpts size=30>
       </span>

     </div>
   </div>



      <div class="col-sm-12 col-xs-12">
      <div class="form_box" style="width: 340px;">
      <label for="fullname">Phone</label>
       <span><i class="fa fa-phone" aria-hidden="true"></i>
            <input placeholder="Phone number"  type=text name="phone" value="<?php if (isset($_GET["phone"])) {
    echo $_GET["phone"];
}
?>"   class=inpts size=30>
       </span>

     </div>
   </div>

     <div class="col-sm-12 col-xs-12">
      <div class="form_box" style="width: 340px;">
      <label for="fullname">Bitcoin Wallet</label>
       <span><i class="fa fa-btc" aria-hidden="true"></i>
            <input placeholder="Your Bitcoin Wallet"  type=text name="bitcoin" value="<?php if (isset($_GET["bitcoin"])) {
    echo $_GET["bitcoin"];
}
?>"  class=inpts size=30>
       </span>

     </div>
   </div>

     <div class="col-sm-12 col-xs-12">
      <div class="form_box" style="width: 340px;">
      <label for="fullname">Bitcoin cash Wallet</label>
       <span><i class="fa fa-bitcoin" aria-hidden="true"></i>
            <input placeholder="Bitcoin Cash Wallet(optional)"  type=text name="bitcash" value="<?php if (isset($_GET["bitcash"])) {
    echo $_GET["bitcash"];
}
?>"   class=inpts size=30>
       </span>

     </div>
   </div>

     <div class="col-sm-12 col-xs-12">
                                    <div class="form_box">
                                        <aside>




<input type=checkbox name=agree value=1 checked disabled > I agree with <a href="rules.php">Terms and conditions</a>


     </aside> </div>  </div>






   <div class="col-sm-12 col-xs-12">
                                    <div class="form_box">
                                        <b> <input  class="btn btn-primary" name="submit"  type=submit value="Signup" class=sbmt></b>
                                    </div>
                                </div>


<div class="col-sm-12 col-xs-12">  <div class="form_box">



</div></div>

</form>



        </div> </div> </div> </div>
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

