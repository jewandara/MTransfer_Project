<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

$disId = $_GET['did'];

if(!districtIdExists($disId)){ header("Location: hospitals.php?did=1"); }

$hospitalData = fetchAllHospital($disId);

$districData = fetchAllDistrict(); 

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
                            <h2 class='mbr-header__text'>MTransfer Hospitals</h2>
                        </div>
                        <div data-form-alert='true'><div class='message_succ'>";

                            echo resultBlock($errors,$successes);
							
                        echo "
						
						</div>
						  </div>

			<div class='top_menu_items'>";
	foreach ($districData as $oV)
	{ 
	if($oV['id'] == $disId)
	{ echo "<a href='hospitals.php?did=".$oV['id']."' class='form-control_menu_select'>".$oV['district']."</a>"; }
	else{ echo "<a href='hospitals.php?did=".$oV['id']."' class='form-control_menu'>".$oV['district']."</a>"; }
	}		
	echo "
		 </div>
		<br/>
			
		<form name='adminHospitals' action='".$_SERVER['PHP_SELF']."' method='post'>
		
			<table class='admin mt_pagetableall'  id='hospitalData'>
				<tr>
					<th>Hospital Number</th>
					<th>Hospital Name</th>
					<th>Hospital Type</th>
					<th>Description</th>
					<th>More</th>
				</tr>";
			foreach ($hospitalData as $v1) {
			echo "
			<tr>
				<td>".$v1['number']."</td>
				<td><a href='".$v1['link']."' target='_blank'>".$v1['hospital']."</a></td>
				<td>".$v1['type']."</td>
				<td><div class='table_items'>".$v1['body']."</div></td>				
				<td>
				  <div class='table_icons'>
					<a href='".$v1['link']."' target='_blank'><img src='assets/images/link.png' width='28'/></a>
					<a href='request_new.php?did=".$disId."&hid=".$v1['id']."' target='_blank'><img src='assets/images/request1.png' width='30'/></a>
				   </div>
				</td>
			</tr>";
			}

			echo "
			</table>
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
