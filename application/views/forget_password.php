<?php
$setting = getSettings();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
      <div class="login-box">
        <div class="login-logo">
          <a href="<?php echo base_url(); ?>"><b><?php echo $setting->title; ?></b></a>
             </div><!-- /.login-logo -->
                <div class="login-box-body">
                   
                     <h4 style=""> <span style="color:#F00;" >
     
 
                  <?php echo $this->session->flashdata('unerror'); ?>  </span>
                
            </h4>
        <form action="" id="loginForm" method="post">
            <input id="id" name="id" hidden value="<?php echo $id;?>">
          <!--<input type="radio" name="as" value="admin">&nbsp;Admin &nbsp;&nbsp;or &nbsp; <input type="radio" name="as" value="store">&nbsp;Store <br><br>-->
           <div class="form-group has-feedback">
               <input type="text" class="form-control" id="password" name="password" placeholder="Password">
               <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
           </div>
           <div class="form-group has-feedback">
               <input type="password" class="form-control" id="conform_password" name="conform_password" placeholder="Conform password">
               <span class="glyphicon glyphicon-lock form-control-feedback"></span>
           </div>
           <div class="row">
            <!-- /.col -->
           <div class="col-xs-12 right">
               <button type="submit" class="btn btn-primary btn-block btn-flat" onClick="validatePassword();">Save</button>
           </div><!-- /.col -->
           </div>
        </form>


      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  </body>
</html>
<script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/jquery.js"></script>
<script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/jquery.validate.js"></script>
<script>
function validatePassword() {
var validator = $("#loginForm").validate({
rules: {
password: "required",
conform_password: {
equalTo: "#password"
}
},
messages: {
password: " Enter Password",
conform_password: " Enter Confirm Password Same as Password"
}
});
if (validator.form()) {
 alert('Password have been reset successfully');
}
}
 
</script>