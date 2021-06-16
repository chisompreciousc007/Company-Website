<?php
require_once 'includes/head.php';
require_once 'includes/functions.php';
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $msg = $_POST["message"];
    sendLog("Message from support! \n email: " . $email . "  \n msg: " . $msg);
    redirect("support.php?success=message sent!");
}
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
                        <h3>support</h3>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="bottom_body inner_page_body">

    	<section class="common_page">
            <div class="container">


<div class="inside_inner">
<div style="margin:0 0 30px">






</div>
  <div class="support-right">

    <div class="contacts">

     <div class="address">
        <h2>Company Details:</h2>
        <h4 style="position:relative;left:4px;color:#fff;">Lorem ipsum</h4>
        <p>Lorem ipsum dolor sit</p>

      </div>
    </div>
    <div class="contacts">
      <div class="email">
        <h2 style="display: inline-flex;">Our E-mail:<span style="color:white;"> </span></h2>
        <p><bold> JohnDoe@email.com</bold>  </p>
	   </h2>

        </div>

    </div>

  </div>
  </div>



<h2 class="common_heading" style="margin-top: 190px;">Contact Form</h2>
<?php showErrorSuccess()?>
   <div class="register_form_inner clearfix" style="width:100%">
                    <div class="row">







<form method=post name=mainform action="support.php">
   <div class="col-sm-12 col-xs-12">
  <div class="col-sm-12 col-xs-12"> <div class="form_box formsupport">

       <span><i class="fa fa-envelope"></i>


<input  placeholder="Your Email" type="email" name="email" value="" size=30 class=inpts>



</span>

 </div> </div>

   <div class="form_box" style="width:97.5%">

       <span><i class="fa  fa-list-alt"></i>

<textarea style="padding-top: 5px;" placeholder="Your Message" name="message" class=inpts></textarea></span>

 </div>
   <div class="form_box">
                                        <b>

<input class="btn btn-primary" name="submit" type=submit value="Send" class=sbmt>

</b>
                                    </div>
   </div>





   <div class="col-sm-6 col-xs-6">  </div>


 <div class="col-sm-12 col-xs-12">  </div>

<div class="col-sm-12 col-xs-12">

                                </div>


</form>

</div></div>


       </div>
        </section>


        <?php
require_once 'includes/secure_section.php';
?>

       </div>
       <?php
require_once 'includes/footer.php';
?>
</wrapper>
</body>
</html>
