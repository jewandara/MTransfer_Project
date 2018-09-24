<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

$UserId = $loggedInUser->user_id;

$SearchUserId = $_GET['id'];

if ($loggedInUser->checkPermission(array(1))){ header("Location: account.php"); }

if(profileIdExists($SearchUserId)){ $profileData = fetchProfile($SearchUserId); }

if(profileContactIdExists($SearchUserId)){ $profileContactData = fetchProfileContact($SearchUserId); }

if(profileExperienceIdExists($SearchUserId)){ $profileExperienceData = fetchProfileExperience($SearchUserId); }

$hospitalData = fetchAllHospitalData();

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
                            <h2 class='mbr-header__text'>Selected User's Profile</h2>
                        </div>
						<div data-form-alert='true'>"; 

echo resultBlock($errors,$successes);
	
echo "</div>
<form name='updateHospital' action='".$_SERVER['PHP_SELF']."' method='post'>

	<table>";


	if(profileIdExists($SearchUserId))
	{ 
		echo "
		<tr><td style='border:0px;'><b>Name</b> :</td>
			<td style='border:0px;'>";		
			if($profileData['Salutation'] == ''){ echo "Mr."; }
			else{ echo "".$profileData['Salutation']; }
			echo " ".$profileData['FirstName']." ".$profileData['LastName']." ".$profileData['SurName']."
			</td>
		</tr>
		
		<tr><td style='border:0px;'><b>Gender</b> :</td>
			<td style='border:0px;'>";		
			if($profileData['Gender'] == 'M'){ echo "Male"; }
			elseif($profileData['Gender'] == 'F'){ echo "Female"; }
			else{ echo "Unknown";}
			echo "
			</td>
		</tr>
		
		<tr>
			<td style='border:0px;'><b>Job Position</b> :</td>
			<td style='border:0px;'>".$profileData['JobPosition']."</td>
		</tr>";
	}
	else
	{
		echo "
		<tr>
			<td style='border:0px;'><b>Sorry Can not find the user.</b></td>
		</tr>";
	}
		
		
		
	if(profileExperienceIdExists($SearchUserId))
	{
	echo "
		<tr>
			<td style='border:0px;'><b>Working Hospital</b> :</td>
			<td style='border:0px;'>";

			if ($profileExperienceData['working_database_id'] == '')
			{ echo "Unknown";}

			foreach ($hospitalData as $v1) 
			{
				$districData = fetchAllDistrict();
				foreach ($districData as $oV)
				{ 				
					if ($v1['district_id'] == $oV['id'])
				 	{
						if ($profileExperienceData['working_database_id'] == $v1['id'])
						{ echo "".$v1['hospital']." in ".$oV['district'].""; }
					}
				}
				$districData = null;
			}

			echo
			"</td>
		</tr>";
	}
		
		
		
	if(profileContactIdExists($SearchUserId))
	{
	echo "
		<tr>
			<td style='border:0px;'><b>Address</b> :</td>
			<td style='border:0px;'>".$profileContactData['HomeAddress']."</td>
		</tr>
		
		<tr>
			<td style='border:0px;'><b>Contact Mobile</b> :</td>
			<td style='border:0px;'>".$profileContactData['ContactMobile']."</td>
		</tr>
		
		<tr>
			<td style='border:0px;'><b>Land Phone</b> :</td>
			<td style='border:0px;'>".$profileContactData['LandPhone']."</td>
		</tr>
		
		<tr>
			<td style='border:0px;'><b>Fax Number</b> :</td>
			<td style='border:0px;'>".$profileContactData['FaxNumber']."</td>
		</tr>";
	}



	echo "
		<tr>
			<td style='border:0px;'>
				<a href='transfers.php' class='mbr-buttons__btn btn btn-lg btn-primary'> < BACK </a>
			</td>
			<td style='border:0px;'></td>
		</tr>
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

