<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

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
                            <h2 class='mbr-header__text'>
							This service is unavailable.<br/>
							We are coming soon</h2> 
							<br/><br/>                  
							<div class='mbr-buttons mbr-buttons--center'>
							<a href='index.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>ACCOUNT PAGE</a>
							<a href='http://mtransfer.lk' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-primary'>HOME PAGE</a>
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

