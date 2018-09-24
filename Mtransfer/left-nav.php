<?php

if (!securePage($_SERVER['PHP_SELF'])){die();}

//Links for logged in user
if(isUserLoggedIn()) {
	echo "
<section class='mbr-navbar mbr-navbar--freeze mbr-navbar--absolute mbr-navbar--sticky mbr-navbar--auto-collapse' id='ext_menu-22'>
    <div class='mbr-navbar__section mbr-section'>
        <div class='mbr-section__container container'>
            <div class='mbr-navbar__container'>
                <div class='mbr-navbar__column mbr-navbar__column--s mbr-navbar__brand'>
                    <span class='mbr-navbar__brand-link mbr-brand mbr-brand--inline'>
                        <span class='mbr-brand__logo'>
							<a href='http://mtransfer.lk'>
					<img src='assets/images/logo-12-256x256-48.png' class='mbr-navbar__brand-img mbr-brand__img' alt='Mobirise'>
							</a>
						</span>
                        <span class='mbr-brand__name'>
							<a class='mbr-brand__name text-white' href='index.php'>MTransfer</a>
						</span>
                    </span>
                </div>
                <div class='mbr-navbar__hamburger mbr-hamburger'><span class='mbr-hamburger__line'></span></div>
                <div class='mbr-navbar__column mbr-navbar__menu'>
                    <nav class='mbr-navbar__menu-box mbr-navbar__menu-box--inline-right'>
                        <div class='mbr-navbar__column'>			
	<ul class='mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-decorator mbr-buttons--active mbr-buttons--only-links'>  
	<li class='mbr-navbar__item'><a class='mbr-buttons__link btn text-white' href='account.php'>HOME</a></li>";
		
	if ($loggedInUser->checkPermission(array(1))){
	echo "
	<li class='mbr-navbar__item'><a class='mbr-buttons__link btn text-white' href='profile.php'>PROFILE</a></li>";
	}		
	if ($loggedInUser->checkPermission(array(2))){
	echo "
	<li class='mbr-navbar__item'><a class='mbr-buttons__link btn text-white' href='http://webmail.mtransfer.lk/'>WEBMAIL</a></li>";
	}	
	if ($loggedInUser->checkPermission(array(3))){
	echo "
	<li class='mbr-navbar__item'><a class='mbr-buttons__link btn text-white' href='profile.php'>PROFILE</a></li>";
	}
	echo "
	<li class='mbr-navbar__item'><a class='mbr-buttons__link btn text-white' href='user_settings.php'>SETTINGS</a></li>
	<li class='mbr-navbar__item'><a class='mbr-buttons__link btn text-white' href='logout.php'>LOGOUT</a></li>
	</ul>
	<ul>
				 		</div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
";
	
	//Links for permission level 2 (default admin)
	//if ($loggedInUser->checkPermission(array(2))){
	//echo "
	//<ul>
	//<li><a href='admin_configuration.php'>Admin Configuration</a></li>
	//<li><a href='admin_users.php'>Admin Users</a></li>
	//<li><a href='admin_permissions.php'>Admin Permissions</a></li>
	//<li><a href='admin_pages.php'>Admin Pages</a></li>
	//</ul>";
	//}
	
} 

else {
	echo "
	<section class='mbr-navbar mbr-navbar--freeze mbr-navbar--absolute mbr-navbar--sticky mbr-navbar--auto-collapse' id='ext_menu-22'>
    <div class='mbr-navbar__section mbr-section'>
        <div class='mbr-section__container container'>
            <div class='mbr-navbar__container'>
                <div class='mbr-navbar__column mbr-navbar__column--s mbr-navbar__brand'>
                    <span class='mbr-navbar__brand-link mbr-brand mbr-brand--inline'>
                        <span class='mbr-brand__logo'>
							<a href='index.php'>
					<img src='assets/images/logo-12-256x256-48.png' class='mbr-navbar__brand-img mbr-brand__img' alt='Mobirise'>
							</a>
						</span>
                        <span class='mbr-brand__name'>
							<a class='mbr-brand__name text-white' href='index.php'>MTransfer</a>
						</span>
                    </span>
                </div>
                <div class='mbr-navbar__hamburger mbr-hamburger'><span class='mbr-hamburger__line'></span></div>
                <div class='mbr-navbar__column mbr-navbar__menu'>
                    <nav class='mbr-navbar__menu-box mbr-navbar__menu-box--inline-right'>
                        <div class='mbr-navbar__column'>			
	<ul class='mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-decorator mbr-buttons--active mbr-buttons--only-links'>  
	<li class='mbr-navbar__item'><a class='mbr-buttons__link btn text-white' href='http://mtransfer.lk/help'>HELP</a></li> 
	<li class='mbr-navbar__item'><a class='mbr-buttons__link btn text-white' href='http://mtransfer.lk/contact'>CONTACT</a></li> 
	<li class='mbr-navbar__item'><a class='mbr-buttons__link btn text-white' href='register.php'>REGISTER</a></li> 
	<li class='mbr-navbar__item'><a class='mbr-buttons__link btn text-white' href='login.php'>LOGIN</a></li>  
	</ul>
	<ul>
				 		</div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
	";
}

?>
