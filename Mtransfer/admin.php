<?php

require_once("models/config.php");

require_once("models/header.php");

include("left-nav.php");

echo "

<section class='mbr-section mbr-section--relative mbr-section--fixed-size mbr-parallax-background mbr-after-navbar' id='form1-48' style='background-image: url(assets/images/wallttt-1200x720-27.png);'>
    
    <div class='mbr-section__container mbr-section__container--std-padding container'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='row'>
                    <div class='col-sm-8 col-sm-offset-2' data-form-type='formoid'>
                        <div class='mbr-header mbr-header--center mbr-header--std-padding'>
                            <h2 class='mbr-header__text'>Regisester New Transfer</h2>
                        </div>
                        <div data-form-alert='true'>";
						
						
                            echo resultBlock($errors,$successes);
							
							
                        echo "
						
						</div>


<div class='form-group'>
	<a href='admin_configuration.php' class='form-control' >HOME </a>
</div>

<div class='form-group'>
	<a href='admin_page.php' class='form-control' >PAGE </a>
</div>

<div class='form-group'>
	<a href='admin_pages.php' class='form-control' >PAGES </a>
</div>

<div class='form-group'>
	<a href='admin_permission.php' class='form-control' >PERMISSION </a>
</div>

<div class='form-group'>
	<a href='admin_permissions.php' class='form-control' >PERMISSIONS </a>
</div>

<div class='form-group'>
	<a href='admin_user.php' class='form-control' >USER </a>
</div>

<div class='form-group'>
	<a href='admin_users.php' class='form-control' >USERs </a>
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
