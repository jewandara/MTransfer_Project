<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

$UserId = $loggedInUser->user_id;

if(!profileExperienceIdExists($UserId)){ 
	createProfileExperience($UserId);
	header("Location: profile_contact.php"); 
}

$mTmonths = array(
1 => 'January', 
2 => 'February', 
3 => 'March', 
4 => 'April', 
5 => 'May',
6 => 'June', 
7 => 'July', 
8 => 'August', 
9 => 'September', 
10 => 'October', 
11 => 'November', 
12 => 'December');


//$hospitalDetails = fetchHospitalDetails(1); 

if(!empty($_POST))
{
	//$DataDisid = $_POST['DistrictID'];
	//$DataHospital = $_POST['hospital'];
	//$DataType = $_POST['type'];
	//$DataNumber = $_POST['number'];
	//$DataCode = $_POST['code'];
	//$DataLink = $_POST['link'];
	//$DataBody = $_POST['body'];
		
	//if (minMaxRange(1, 7, $DataNumber)){ $errors[] = lang("HOSPITAL_NUMBER_LIMIT", array(1, 7)); }
	//elseif (minMaxRange(4, 60, $DataHospital)){ $errors[] = lang("HOSPITAL_CHAR_LIMIT", array(4, 60)); }
	//elseif (!is_numeric($DataNumber)){ $errors[] = lang("HOSPITAL_IS_NUMERIC", array($DataNumber)); }
	//elseif (updateHospital($hospitalId, $DataDisid, $DataHospital, $DataType, $DataNumber, $DataCode, $DataLink, $DataBody))
	//{
	//	$successes[] = lang("HOSPITEL_NAME_UPDATE", array($DataHospital));
	//	header("Refresh:0");
	//}
	//else { $errors[] = lang("SQL_ERROR"); }
	
	updateProfileExperience($UserId, $_POST['hospital_id'], $_POST['RegNumber'], $_POST['Diploma'], $_POST['Degree'], $_POST['Institution'], $_POST['OtherExperence']);
	$successes[] = ' Update Successfully';
	
	
	}


$profileExperienceData = fetchProfileExperience($UserId);

$hospitalData = fetchAllHospitalData();

require_once("models/header.php");

include("left-nav.php");

echo "

<section class='mbr-section mbr-section--relative mbr-section--fixed-size mbr-parallax-background mbr-after-navbar' id='form1-48' style='background-image: url(assets/images/wallttt-1200x720-27.png);'>
    
    <div class='mbr-section__container mbr-section__container--std-padding container'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='row'>
                    <div class='col-sm-8 col-sm-offset-2' data-form-type='formoid'>";
					
					
if ($loggedInUser->checkPermission(array(1))){
	               	header("Location: profile.php"); 
					}
if ($loggedInUser->checkPermission(array(3))){ 	               
					echo "<div class='mbr-header mbr-header--center mbr-header--std-padding'>
                            <h2 class='mbr-header__text'>Hospital User Experience</h2>
                        </div>
						<br/>
						<a href='profile.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-default'> PROFILE DETAILS </a>
						<a href='profile_contact.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-default'> CONTACT DETAILS </a>
						<a href='profile_experience.php' class='mbr-buttons__btn btn btn-lg btn-primary'> EXPERIENCE DETAILS </a>
						<br/>
						<div data-form-alert='true'>"; }

echo resultBlock($errors,$successes);
	
echo "</div>
<form name='updateHospital' action='".$_SERVER['PHP_SELF']."' method='post'>

	<table>

		<tr>
			<td style='border:0px;width:25%'>Hospital Name:</td>
			<td style='border:0px;'>
			<select class='form-control_select' name='hospital_id''>";

			if ($profileExperienceData['working_database_id'] == '')
			{ echo "<option class='form-control_option' value='' selected> SELECT YOUR HOSPITAL </option>";}

			foreach ($hospitalData as $v1) 
			{
				$districData = fetchAllDistrict();
				foreach ($districData as $oV)
				{ 				
					if ($v1['district_id'] == $oV['id'])
				 	{
			if ($profileExperienceData['working_database_id'] == $v1['id'])
			{ 
	echo "<option class='form-control_option' value='".$v1['id']."' selected>".$oV['district']." - ".$v1['hospital']."</option>"; 
			}
			echo "<option class='form-control_option' value='".$v1['id']."'>".$oV['district']." - ".$v1['hospital']."</option>";
					}
				}
				$districData = null;
			}
	
	echo "
			</select>
			</td>
		</tr>
		
		<tr>
			<td style='border:0px;width:25%'>Reg Number:</td>
			<td style='border:0px;'>
			<input type='text' name='RegNumber' class='form-control_text' value='".$profileExperienceData['RegNumber']."' />
			</td>
		</tr>
		
		<tr>
			<td style='border:0px;width:25%'>Institution:</td>
			<td style='border:0px;'>
			<input type='text' name='Institution' class='form-control_text' value='".$profileExperienceData['Institution']."' />
			</td>
		</tr>
		
		<tr>
			<td style='border:0px;width:25%'>Diploma:</td>
			<td style='border:0px;'>
			<input type='text' name='Diploma' class='form-control_text' value='".$profileExperienceData['Diploma']."' />
			</td>
		</tr>
		
		<tr>
			<td style='border:0px;width:25%'>Degree:</td>
			<td style='border:0px;'>
			<input type='text' name='Degree' class='form-control_text' value='".$profileExperienceData['Degree']."' />
			</td>
		</tr>
		
		<tr>
			<td style='border:0px;width:25%'>Other Experence:</td>
			<td style='border:0px;'>
		<input type='text' name='OtherExperence' class='form-control_text' value='".$profileExperienceData['OtherExperence']."'/>
			</td>
		</tr>
		
		<tr>
			<td style='border:0px;'><input type='submit' value='UPDATE' class='mbr-buttons__btn btn btn-lg btn-primary' /></td>
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

