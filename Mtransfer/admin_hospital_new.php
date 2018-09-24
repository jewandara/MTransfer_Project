<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

if(!empty($_POST))
{
	if(!empty($_POST['newHospital'])) 
	{
		$Hospital = $_POST['newHospital'];
		$HospitalNumber = $_POST['hospitalNumber'];
		$HospitalType = $_POST['hospitalType'];
		$DistrictID = $_POST['DistrictID'];
		
		if (hospitalNumberExists($HospitalNumber)){ $errors[] = lang("HOSPITAL_NUMBER_IN_USE", array($HospitalNumber)); }
		elseif (minMaxRange(4, 60, $Hospital)){ $errors[] = lang("HOSPITAL_CHAR_LIMIT", array(4, 60)); }
		elseif (!is_numeric($HospitalNumber)){ $errors[] = lang("HOSPITAL_IS_NUMERIC", array($HospitalNumber)); }
		elseif ($HospitalType == '-1'){ $errors[] = lang("HOSPITAL_SELECT_TYPE", array($Hospital)); }
		elseif ($DistrictID == '-1'){ $errors[] = lang("HOSPITAL_SELECT_DISTRICT", array($Hospital)); }
		else{
			if (createHospital($Hospital, $HospitalNumber, $HospitalType, $DistrictID) )
			{
				$successes[] = lang("HOSPITAL_CREATION_SUCCESSFUL", array($Hospital));
				header("Location: admin_hospitals.php"); die();
			}
			else { $errors[] = lang("SQL_ERROR"); }
		}
	}
}

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
                            <h2 class='mbr-header__text'>MTransfer New Hospital</h2>
                        </div>
                        <div data-form-alert='true'><div class='message_succ'>";

                            echo resultBlock($errors,$successes);
							
                        echo "
						
						</div></div>

		<form name='adminAddHospitals' action='".$_SERVER['PHP_SELF']."' method='post'>
		
				<table>
				<tr>
					<td style='border:0px;'>
						<input type='text' name='newHospital' class='form-control' required placeholder='Hospitel Name'/>
					</td>
					<td style='border:0px;'>
						<input type='text' name='hospitalNumber' class='form-control' required placeholder='Hospitel Number'/>
					</td>
				</tr>
						
				<tr>
					<td style='border:0px;'>									
						<select class='form-control_select' name='hospitalType''>
							<option class='form-control_option' value='-1' selected> SELECT HOSPITEL TYPE </option>
							<option class='form-control_option' value='District General  Hospital'>District General  Hospital</option>
							<option class='form-control_option' value='Provincial General Hospital'>Provincial General Hospital</option>
							<option class='form-control_option' value='Primary Medical Care Unit'>Primary Medical Care Unit</option>
							<option class='form-control_option' value='National  Hospital'>National  Hospital</option>
							<option class='form-control_option' value='Teaching Hospital'>Teaching Hospital</option>
							<option class='form-control_option' value='Base Hospital Type A'>Base Hospital Type A</option>
							<option class='form-control_option' value='Base Hospital Type B'>Base Hospital Type B</option>
							<option class='form-control_option' value='Divisional Hospital Type A'>Divisional Hospital Type A</option>
							<option class='form-control_option' value='Divisional Hospital Type B'>Divisional Hospital Type B</option>
							<option class='form-control_option' value='Divisional Hospital Type C'>Divisional Hospital Type C</option>
						</select>
					</td>
					<td style='border:0px;'>
						<select class='form-control_select' name='DistrictID''>
							<option class='form-control_option' value='-1' selected> SELECT DISTRICT </option>";

							foreach ($districData as $oV){
						echo "<option class='form-control_option' value='".$oV['id']."'>".$oV['district']."</option>";
							}		

						echo "
						</select>
					</td>
				</tr>
				
				<tr>
					<td style='border:0px;'>
						<input type='submit' name='Submit' value='ADD' class='mbr-buttons__btn btn btn-lg btn-primary'/>
					</td>
					<td style='border:0px;'></td>
				</tr>
				
			</table>
		</form>
		
		
					<br/><br/>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

";

require_once("models/footer.php");

?>
