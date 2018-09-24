<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

include("left-nav.php");

//teacher
if ($loggedInUser->checkPermission(array(1))){
echo "
<section class='mbr-section mbr-section--relative mbr-section--fixed-size mbr-after-navbar' id='features1-10' style='background-color: rgb(255, 255, 255);'>
    <div class='mbr-section__container container mbr-section__container--std-top-padding'>
        <div class='mbr-section__row row'>
	
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='profile.php'>
							<img src='assets/images/profile-300x300-13.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='profile.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>PROFILE</a>
					</div>
                </div>
            </div>
			
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='requests.php'>
							<img src='assets/images/request-300x300-42.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='requests.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>REQUEST</a>
					</div>
                </div>
            </div>
			
            <div class='clearfix visible-sm-block'></div>
			
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='transfers.php'>
							<img src='assets/images/transfer-300x300-78.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='transfers.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>TRANSFERS</a>
					</div>
                </div>
            </div>
            
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='schools.php'>
						<img src='assets/images/school2-300x300-59.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='schools.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>SCHOOLS</a>
					</div>
                </div>
            </div>
            
        </div>
    </div>
</section>
";
}

//administrator
else if ($loggedInUser->checkPermission(array(2))){
echo "
<section class='mbr-section mbr-section--relative mbr-section--fixed-size mbr-after-navbar' id='features1-10' style='background-color: rgb(255, 255, 255);'>
    <div class='mbr-section__container container mbr-section__container--std-top-padding'>
        <div class='mbr-section__row row'>
		
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='admin_configuration.php'>
							<img src='assets/images/configerations_300x300-13.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='admin_configuration.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>CONFIGURATION</a>
					</div>
                </div>
            </div>
			
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='admin_permissions.php'>
							<img src='assets/images/permisions_300x300-13.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='admin_permissions.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>PERMISSIONS</a>
					</div>
                </div>
            </div>
			
            <div class='clearfix visible-sm-block'></div>
			
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='admin_pages.php'>
							<img src='assets/images/pages_300x300-13.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='admin_pages.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>PAGES</a>
					</div>
                </div>
            </div>
            
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='admin_users.php'>
						<img src='assets/images/users_300x300-13.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='admin_users.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>USERS</a>
					</div>
                </div>
            </div>

            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='transfers.php'>
						<img src='assets/images/transfer-300x300-78.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='transfers.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>TRANSFERS</a>
					</div>
                </div>
            </div>            
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='unavailable.php'>
						<img src='assets/images/request-300x300-42.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='unavailable.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>REQUEST</a>
					</div>
                </div>
            </div>            
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='unavailable.php'>
						<img src='assets/images/school2-300x300-59.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='unavailable.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>SCHOOLS</a>
					</div>
                </div>
            </div>            
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='admin_hospitals.php'>
						<img src='assets/images/hospitel-300x300-9.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='admin_hospitals.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>HOSPITALS</a>
					</div>
                </div>
            </div>

        </div>
    </div>
</section>
";
}

//nurse
else if ($loggedInUser->checkPermission(array(3))){
echo "
<section class='mbr-section mbr-section--relative mbr-section--fixed-size mbr-after-navbar' id='features1-10' style='background-color: rgb(255, 255, 255);'>
    <div class='mbr-section__container container mbr-section__container--std-top-padding'>
        <div class='mbr-section__row row'>
		
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='profile.php'>
							<img src='assets/images/profile-300x300-13.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='profile.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>PROFILE</a>
					</div>
                </div>
            </div>
			
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='requests.php'>
							<img src='assets/images/request-300x300-42.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='requests.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>REQUEST</a>
					</div>
                </div>
            </div>
			
            <div class='clearfix visible-sm-block'></div>
			
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='transfers.php'>
							<img src='assets/images/transfer-300x300-78.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='transfers.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>TRANSFERS</a>
					</div>
                </div>
            </div>
            
            <div class='mbr-section__col col-xs-12 col-md-3 col-sm-6'>
                <div class='mbr-section__container mbr-section__container--center mbr-section__container--middle'>
                    <figure class='mbr-figure'>
						<a href='hospitals.php'>
						<img src='assets/images/hospitel-300x300-9.png' class='mbr-figure__img user_icon' width='225'>
						</a>
					</figure>
                </div>
                <div class='mbr-section__container mbr-section__container--last'>
                    <div class='mbr-buttons mbr-buttons--center'>
						<a href='hospitals.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>HOSPITELS</a>
					</div>
                </div>
            </div>
            
        </div>
    </div>
</section>
";
}

require_once("models/account-footer.php");

?>
