<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


<!------ Include the above in your HEAD tag ---------->

<link href="css/style.css" rel="stylesheet" />


<!-- Include the above in your HEAD tag -->

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body>
<?php
$email="monweb_assist2@monstateinvestment.com";
$pwd="2829@assist2";
echo base64_encode($email)."<br/>";
echo base64_encode($pwd);
?>
<div class="main">
    
    
    <div class="container">
<center>
<div class="middle">
      <div id="login">

        <form action="javascript:void(0);" method="get">

          <fieldset class="clearfix">

            <p ><span class="fa fa-user"></span><input type="text"  Placeholder="Username" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
            <p><span class="fa fa-lock"></span><input type="password"  Placeholder="Password" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
            
             <div>
                                <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="#">Forgot
                                password?</a></span>
                                <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="Sign In"></span>
                            </div>

          </fieldset>
<div class="clearfix"></div>
        </form>

        <div class="clearfix"></div>

      </div> <!-- end login -->
      <div class="logo">LOGO
          
          <div class="clearfix"></div>
      </div>
      
      </div>
</center>
    </div>

</div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
