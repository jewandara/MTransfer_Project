<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
if(isUserLoggedIn()) { header("Location: account.php"); die(); }
if(!empty($_POST))
{
	$errors = array();
	$email = trim($_POST["email"]);
	$username = trim($_POST["username"]);
	$displayname = trim($_POST["displayname"]);
	$password = trim($_POST["password"]);
	$confirm_pass = trim($_POST["passwordc"]);
	$captcha = md5($_POST["captcha"]);
	
	if ($captcha != $_SESSION['captcha']){ $errors[] = lang("CAPTCHA_FAIL"); }
	if(minMaxRange(5,30,$username)){ $errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(5,25)); }
	if(minMaxRange(5,25,$displayname)){ $errors[] = lang("ACCOUNT_DISPLAY_CHAR_LIMIT",array(5,25)); }
	if(!ctype_alnum($displayname)){ $errors[] = lang("ACCOUNT_DISPLAY_INVALID_CHARACTERS"); }
	if(minMaxRange(8,50,$password) && minMaxRange(8,50,$confirm_pass)){ $errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(8,50)); }
	else if($password != $confirm_pass) { $errors[] = lang("ACCOUNT_PASS_MISMATCH"); }
	if(!isValidEmail($email)) { $errors[] = lang("ACCOUNT_INVALID_EMAIL"); }
	if(count($errors) == 0)
	{ 
		$user = new User($username,$displayname,$password,$email);
		if(!$user->status)
		{
			if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
			if($user->displayname_taken) $errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE",array($displayname));
			if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));		
		}
		else
		{
			if(!$user->userCakeAddTeacher())
			{
				if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
				if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
			}
		}
	}
	if(count($errors) == 0) {
		$successes[] = $user->success;
	}
}

require_once("models/header.php");
include("left-nav.php");
echo "

<section class='mbr-section mbr-section--relative mbr-section--fixed-size mbr-parallax-background mbr-after-navbar' id='form1-48' style='background-image: url(assets/images/wallttt-1200x720-27.png);   margin-top: -50px;'>
    
    <div class='mbr-section__container mbr-section__container--std-padding container'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='row'>
                    <div class='col-sm-8 col-sm-offset-2' data-form-type='formoid'>
                        <div class='mbr-header mbr-header--center mbr-header--std-padding'>
                            <h2 class='mbr-header__text'><img src='assets/images/schools.png' class='mbr-figure__img' width='150px'>    Register For School</h2>
                        </div>
                        <div data-form-alert='true'>";
						
						
                            echo resultBlock($errors,$successes);
							
							
                        echo "
						
						</div>

<form name='newUser' action='".$_SERVER['PHP_SELF']."' method='post' data-form-title='Regisester New Teacher'>

<div class='form-group'>
	Enter Your Email Address:<br><br>
	<input type='text' name='username' class='form-control' required placeholder='EMAIL' data-form-field='Name'>
</div>

<div class='form-group'>
	 Enter Your Confirm Email Address:<br><br>
	<input type='email' name='email' class='form-control' required placeholder='CONFIRM EMAIL' data-form-field='Email'>
</div>

<div class='form-group'>
	Enter Your Government ID:<br><br>
	<input type='text' name='displayname' class='form-control' required placeholder='GOVERNMENT ID ( Ex: NIC NO / TEACHER REG NO )' data-form-field='Name'>
</div>

<div class='form-group'>
	Enter Your Password:<br><br>
	<input type='password' name='password' class='form-control' required placeholder='PASSWORD' data-form-field='Name'>
</div>

<div class='form-group'>
	Enter Your Confirm Password:<br><br>
	<input type='password' name='passwordc' class='form-control' required placeholder='CONFIRM PASSWORD' data-form-field='Name'>
</div>



<div class='form-group'>
	Enter The Sequrity Code Bellow:<br><br>
	<img src='models/captcha.php' class='form-control' height='120px'>
</div>
<div class='form-group'>
	<input name='captcha' type='text' class='form-control' required placeholder='SEQURITY CODE' data-form-field='Name'>
</div>

<div class='mbr-buttons mbr-buttons--right'>
	<button type='submit' class='mbr-buttons__btn btn btn-lg btn-primary'>REGISTER AS TEACHER</button>
</div>


</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
";

require_once("models/footer.php");

?>
