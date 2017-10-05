<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    
        <link rel="stylesheet" href="css/style.css">  
    
    
  </head>

  <body>

    <div class="login-page">
  <div class="form">
  <?php if(validation_errors()) { ?>
            <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
            </div>
                     <?php } ?>
    <form class="register-form" method="post">
       <input type="text" placeholder="email address" name="email"/>
      <input type="password" placeholder="password" name="password"/>
     
	  
      <button type="submit">login</button>
      <p class="message">Already registered? <a href="#">Sign up</a></p>
    </form>
    <form class="login-form" method="post">
      <input type="text" placeholder="first name" name="first_name" required/>
	   <input type="text" placeholder="last name" name="last_name" required/>
      <input type="password" placeholder="password" name="password" required/>
      <input type="email" placeholder="email address" name="email" required/>
	   <input type="text" placeholder="phone" name="phone" required/>
      <button type="submit">create</button>
     
    <p class="message">Already registered? <a href="<?php echo base_url();?>Clickkart/login">Sign In</a></p>
      
    </form>
  </div>
</div>
    <script src="js/jquery.min.js"></script>

        <script src="js/index.js"></script>
    
    
    
  </body>
</html>
