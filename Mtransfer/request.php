<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

//----------------------------------------------------------------------------
if ($loggedInUser->checkPermission(array(1))){ header("Location: unavailable.php"); }
//----------------------------------------------------------------------------

$hospitalId = $_GET['id'];

if(!hospitalIdExists($hospitalId)){ header("Location: account.php"); }

$hospitalDetails = fetchHospitalDetails($hospitalId); 

if(!empty($_POST))
{
	$DataDisid = $_POST['DistrictID'];
	$DataHospital = $_POST['hospital'];
	$DataType = $_POST['type'];
	$DataNumber = $_POST['number'];
	$DataCode = $_POST['code'];
	$DataLink = $_POST['link'];
	$DataBody = $_POST['body'];
		
	if (minMaxRange(1, 7, $DataNumber)){ $errors[] = lang("HOSPITAL_NUMBER_LIMIT", array(1, 7)); }
	elseif (minMaxRange(4, 60, $DataHospital)){ $errors[] = lang("HOSPITAL_CHAR_LIMIT", array(4, 60)); }
	elseif (!is_numeric($DataNumber)){ $errors[] = lang("HOSPITAL_IS_NUMERIC", array($DataNumber)); }
	elseif (updateHospital($hospitalId, $DataDisid, $DataHospital, $DataType, $DataNumber, $DataCode, $DataLink, $DataBody))
	{
		$successes[] = lang("HOSPITEL_NAME_UPDATE", array($DataHospital));
		header("Refresh:0");
	}
	else { $errors[] = lang("SQL_ERROR"); }
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
                            <h2 class='mbr-header__text'>MTransfer Update Hospital</h2>
                        </div>
                        <div data-form-alert='true'>";
						
                            echo resultBlock($errors,$successes);
	
                        echo "
						
						</div>
						
						
<form name='updateHospital' action='".$_SERVER['PHP_SELF']."?id=".$hospitalId."' method='post'>

	<table>
		<tr>
			<td style='border:0px;width:25%'>ID:</td>
			<td style='border:0px;'>
			<input type='text' name='hid' class='form-control_text' value='".$hospitalDetails['id']."' style='background:#D7DCD3;' readonly />
			</td>
		</tr>

		<tr>
			<td style='border:0px;'>Hospital:</td>
			<td style='border:0px;'>
			<input type='text' name='hospital' class='form-control_text' value='".$hospitalDetails['hospital']."' />
			</td>
		</tr>

		<tr>
			<td style='border:0px;'>Type:</td>
			<td style='border:0px;'>
			<select class='form-control_select' name='type''>
				<option class='form-control_option' value='".$hospitalDetails['type']."' selected>".$hospitalDetails['type']."</option>
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
		</tr>

		<tr>
			<td style='border:0px;'>District:</td>
			<td style='border:0px;'>
		<select class='form-control_select' name='DistrictID''>";
		foreach ($districData as $oV)
		{
			if($oV['id'] == $hospitalDetails['district_id'])
			{ echo "<option class='form-control_option' value='".$oV['id']."' selected>".$oV['district']."</option>"; }
			else
			{ echo "<option class='form-control_option' value='".$oV['id']."'>".$oV['district']."</option>"; }
		}		
	echo "</select>
		</td>
		</tr>
		<tr>
			<td style='border:0px;'>Code:</td>
			<td style='border:0px;'>
			<input type='text' name='code' class='form-control_text' value='".$hospitalDetails['code']."' />
			</td>
		</tr>
		<tr>
			<td style='border:0px;'>Number:</td>
			<td style='border:0px;'>
			<input type='text' name='number' class='form-control_text' value='".$hospitalDetails['number']."' />
			</td>
		</tr>
		<tr>
			<td style='border:0px;'>Link:</td>
			<td style='border:0px;'>
			<input type='text' name='link' class='form-control_text' value='".$hospitalDetails['link']."' />
			</td>
		</tr>
		<tr>
			<td style='border:0px; vertical-align:text-top;'></td>
			<td style='border:0px;'>
			<textarea rows='5' name='body' class='form-control_text'>".$hospitalDetails['body']."</textarea>
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

