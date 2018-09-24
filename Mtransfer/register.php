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

<section class='mbr-section mbr-section--relative mbr-section--fixed-size mbr-parallax-background mbr-after-navbar' id='form1-48' style='background-image: url(assets/images/wallttt-1200x720-27.png); margin-top: -30px;'>
    <div class='mbr-section__container mbr-section__container--std-padding container'>
        <div class='row'>

		<div class='mbr-header mbr-header--center mbr-header--std-padding'>
			<h2 class='mbr-header__text'>Register New User</h2>
		</div>

			<div class='mbr-section__col col-xs-12 col-sm-6'>
				<div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'><a href='register_school.php'><img src='assets/images/schools.png' class='mbr-figure__img user_icon_register'></a></figure>
                </div>

                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
					<a href='register_school.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-default'>REGISTER FOR SCHOOL</a>
					</div>
                </div>
            </div>
			
            <div class='mbr-section__col col-xs-12 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'><a href='register_hospital.php'><img src='assets/images/hospitil.png' class='mbr-figure__img user_icon_register'></a></figure>
                </div>

                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
					<a href='register_hospital.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-default'>REGISTER FOR HOSPITAL</a>
					</div>
                </div>
            </div>

        </div>
    </div>
</section>
";

require_once("models/footer.php");

?>
