<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}
//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: account.php"); die(); }

require_once("models/header.php");

include("left-nav.php");
	
echo "
<section class='mbr-box mbr-section mbr-section--relative mbr-section--fixed-size mbr-section--full-height mbr-section--bg-adapted mbr-parallax-background mbr-after-navbar' id='header1-27' style='background-image: url(assets/images/backgro-1200x720-28.png);'>
    <div class='mbr-box__magnet mbr-box__magnet--sm-padding mbr-box__magnet--center-left'>
        <div class='mbr-box__container mbr-section__container container'>
            <div class='mbr-box mbr-box--stretched'>
				<div class='mbr-box__magnet mbr-box__magnet--center-left'>
                <div class='row'>
					<div class=' col-sm-6 col-sm-offset-6'>
                    	<div class='mbr-hero animated fadeInUp'>
                        	<h1 class='mbr-hero__text'>MTransfer.lk</h1>
                        	<p class='mbr-hero__subtext'></p>
							<p>Are You looking for a transfer for a school or hospitil. Then Here is Your chance for mutual transfer for srilankan Nurses and Teachers. Hary up Now. It Free<br><br><br>
							<a href='forgot-password.php' class='text-primary'>Forget Password</a><br>
							<a href='resend-activation.php' class='text-primary'>Resend Actvation Email</a><br>
							<p>
							</p>
                    	</div>
                    	<div class='mbr-buttons btn-inverse mbr-buttons--left'>
						<a class='mbr-buttons__btn btn btn-lg animated fadeInUp delay btn-primary' href='login.php'>LOGIN</a> 
						<a class='mbr-buttons__btn btn btn-lg animated fadeInUp delay btn-primary' href='register.php'>REGISTER</a>
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
