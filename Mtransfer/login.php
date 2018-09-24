<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$username = sanitize(trim($_POST["username"]));
	$password = trim($_POST["password"]);
	
	//Perform some validation
	//Feel free to edit / change as required
	if($username == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
	}
	if($password == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}

	if(count($errors) == 0)
	{
		//A security note here, never tell the user which credential was incorrect
		if(!usernameExists($username))
		{
			$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
		}
		else
		{
			$userdetails = fetchUserDetails($username);
			//See if the user's account is activated
			if($userdetails["active"]==0)
			{
				$errors[] = lang("ACCOUNT_INACTIVE");
			}
			else
			{
				//Hash the password and use the salt from the database to compare the password.
				$entered_pass = generateHash($password,$userdetails["password"]);
				
				if($entered_pass != $userdetails["password"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
				}
				else
				{
					//Passwords match! we're good to go'
					
					//Construct a new logged in user object
					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->title = $userdetails["title"];
					$loggedInUser->displayname = $userdetails["display_name"];
					$loggedInUser->username = $userdetails["user_name"];
					
					//Update last sign in
					$loggedInUser->updateLastSignIn();
					$_SESSION["userCakeUser"] = $loggedInUser;
					
					//Redirect to user account page
					header("Location: account.php");
					die();
				}
			}
		}
	}
}

require_once("models/header.php");

include("left-nav.php");

echo "

<section class='mbr-section mbr-section--relative mbr-section--fixed-size mbr-parallax-background mbr-after-navbar' id='form1-48' style='background-image: url(assets/images/wallttt-1200x720-27.png);  margin-top: -30px;'>
    
    <div class='mbr-section__container mbr-section__container--std-padding container'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='row'>
                    <div class='col-sm-8 col-sm-offset-2' data-form-type='formoid'>
                        <div class='mbr-header mbr-header--center mbr-header--std-padding'>
                            <h4 class='mbr-header__text'>Login mTransfer</h4>
                        </div>
                        <div data-form-alert='true'>";
                            echo resultBlock($errors,$successes);
                        echo "
						</div>
        
        <div class='mbr-section__row row'>
            <div class='mbr-section__col col-xs-12 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'><img src='assets/images/login_bg.png' class='mbr-figure__img'></figure>
                </div>
            </div> 
			
        
            <div class='mbr-section__col col-xs-12 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
				
				<form name='login' action='".$_SERVER['PHP_SELF']."' method='post' data-form-title='Login User For Transfer'>
					<div class='form-group'>
						<input type='text' name='username' class='form-control' required placeholder='Enter Your Email' data-form-field='Name'>
					</div>					<div class='form-group'>
						<input type='password' name='password' class='form-control' required placeholder='Enter Your Password' data-form-field='Name'>
					</div>
					<div class='mbr-buttons mbr-buttons--right'>
						<button type='submit' class='mbr-buttons__btn btn btn-lg btn-primary'>LOGIN</button>
					</div>
				</form>
				
                </div>
            </div>
		</div>




                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
";

require_once("models/footer.php");

?>
