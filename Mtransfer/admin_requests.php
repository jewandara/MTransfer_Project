<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

$disId = $_GET['did'];

if(!districtIdExists($disId)){ header("Location: admin_hospitals.php?did=1"); }

if(!empty($_POST))
{
	if(!empty($_POST['delete'])){
		$deletions = $_POST['delete'];
		if ($deletion_count = deleteHospital($deletions)){
			$successes[] = lang("HOSPITAL_DELETIONS_SUCCESSFUL", array($deletion_count));
		}
	}
}

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
                            <h2 class='mbr-header__text'>MTransfer Hospital Database</h2>
                        </div>
                        <div data-form-alert='true'><div class='message_succ'>";

                            echo resultBlock($errors,$successes);
							
                        echo "
						
						</div>
							<a href='admin_hospital_new.php' class='mbr-buttons__btn btn btn-lg btn-primary'> ADD NEW HOSPITAL </a>
							<br/>
						</div>

			<div class='top_menu_items'>";
	foreach ($districData as $oV)
	{ 
	if($oV['id'] == $disId)
	{ echo "<a href='admin_hospitals.php?did=".$oV['id']."' class='form-control_menu_select'>".$oV['district']."</a>"; }
	else{ echo "<a href='admin_hospitals.php?did=".$oV['id']."' class='form-control_menu'>".$oV['district']."</a>"; }
	}		
	echo "
		 </div>
		<br/>
			
		<form name='adminHospitals' action='".$_SERVER['PHP_SELF']."' method='post'>
		
			<table class='admin mt_pagetableall'>
				<tr>
					<th>Delete</th>
					<th>ID</th>
					<th>Hospital Name</th>
					<th>Type</th>
				</tr>";
			foreach ($hospitalData as $v1) {
			echo "
			<tr>
				<td><input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'></td>
				<td>".$v1['id']."</td>
				<td><a href='admin_hospital.php?id=".$v1['id']."'>".$v1['hospital']."</a></td>
				<td>".$v1['type']."</td>
			</tr>";
			}

			echo "
			</table>
			<p><br/></p>                                
			<input type='submit' name='Submit' value='DELETE' class='mbr-buttons__btn btn btn-lg btn-primary'/>
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
