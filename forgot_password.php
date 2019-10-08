<html>

 <head>
  <title>POOS Small Project</title>
  <style>
      body{
          background-image: url("back.png");
          background-repeat: no-repeat;
          background-size: cover;

      }
  </style>
 </head>
 <form action="poosproject.com">
   <input type="submit" value="Home">
  </form>
  <form action="/login.php">
   <input type="submit" value="Login">
  </form>

<?php
    $msg ="test";
    $msg = wordwrap($msg,70);
    mail("dat.npt@gmai.com", "Test", $msg);
?>

 <body>
    <center>
        <br><br><br><br>
        <form name="frmForgot" id="frmForgot" method="post" onSubmit="return validate_forgot();">
<div align = "left"> <h1>Forgot Password?</h1> </div>
	<?php if(!empty($success_message)) { ?>
	<div class="success_message"><?php echo $success_message; ?></div>
	<?php } ?>

	<div id="validation-message">
		<?php if(!empty($error_message)) { ?>
	<?php echo $error_message; ?>
	<?php } ?>
	</div>

	<div align= "left" class="field-group">
		<div><label for="username">Username</label></div>
		<div><input type="username" name="Username" id="Username" class="input-field" placeholder = "Username" require><br> <br> AND <br><br></div>
	</div>

	<div align = "left" class="field-group">
		<div><label for="email">Email</label></div>
		<div><input type="email" name="Email" id="Email" class="input-field" placeholder= "Email" require></div>
	</div><br>

	<div align ="left" class="field-group">
		<div><input type="submit" name="forgot-password" id="forgot-password" value="Submit" class="form-submit-button"></div>
	</div>
</form>

    </center>

 </body>
</html>
