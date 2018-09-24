<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

$UserId = $loggedInUser->user_id;

if(!profileIdExists($UserId)){ 
	if ($loggedInUser->checkPermission(array(1))){ createProfile($UserId, 'S'); }
	if ($loggedInUser->checkPermission(array(3))){ createProfile($UserId, 'H'); }
	header("Location: profile.php"); 
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
	
	updateProfile($UserId, $_POST['Salutation'], $_POST['JobPosition'], $_POST['FirstName'], $_POST['LastName'], $_POST['SurName'],$_POST['MarriedStatus'], $_POST['BirthDay'], $_POST['BirthMonth'], $_POST['BirthYear'], $_POST['Gender']);
	
	$successes[] = ' Update Successfully';
	
	}


$profileData = fetchProfile($UserId);

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
	               echo "<div class='mbr-header mbr-header--center mbr-header--std-padding'>
                            <h2 class='mbr-header__text'>School User Profile</h2>
                        </div>						
						<br/>
						<a href='profile.php' class='mbr-buttons__btn btn btn-lg btn-primary'> PROFILE DETAILS </a>
						<a href='profile_contact.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-default'> CONTACT DETAILS </a>
						<br/>
						<div data-form-alert='true'>"; }
if ($loggedInUser->checkPermission(array(3))){ 	               
					echo "<div class='mbr-header mbr-header--center mbr-header--std-padding'>
                            <h2 class='mbr-header__text'>Hospital User Profile</h2>
                        </div>
						<br/>
						<a href='profile.php' class='mbr-buttons__btn btn btn-lg btn-primary'> PROFILE DETAILS </a>
						<a href='profile_contact.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-default'> CONTACT DETAILS </a>
						<a href='profile_experience.php' class='mbr-buttons__btn btn btn-wrap btn-xs-lg btn-default'> EXPERIENCE DETAILS </a>
						<br/>
						<div data-form-alert='true'>"; }

echo resultBlock($errors,$successes);
	
echo "</div>
<form name='updateHospital' action='".$_SERVER['PHP_SELF']."' method='post'>

	<table>
		<tr>
			<td style='border:0px;width:25%'>ID:</td>
			<td style='border:0px;'>
			<input type='text' name='user_id' class='form-control_text' value='  ".$profileData['user_id']."' style='background:#FFCCCC; border:0px; width:255px' readonly /> - <input type='text' name='DatabaseType' class='form-control_text' value='   ".$profileData['DatabaseType']."  ' style='background:#FFCCCC; border:0px; width:40px' readonly />
			</td>
		</tr>
		
		<tr>
			<td style='border:0px;'>Birth Day:</td>
			<td style='border:0px;'>
			
			<select class='form-control_select' name='BirthDay' style='width:80px' >";		
			if($profileData['BirthDay'] == ''){				
				echo "<option class='form-control_option' value='' selected > DAY </option>";			
				for ($x = 1; $x <= 31; $x++) { echo "<option class='form-control_option' value='$x'>$x</option>"; }
			}
			else{
				echo "<option class='form-control_option' value='".$profileData['BirthDay']."' selected>".$profileData['BirthDay']."</option>";
				for ($x = 1; $x <= 32; $x++) { echo "<option class='form-control_option' value='$x'>$x</option>"; }
			}
			echo "	
			</select>

			<select class='form-control_select' name='BirthMonth' style='width:120px' >";		
	if($profileData['BirthMonth'] == ''){				
		echo "<option class='form-control_option' value='' selected > MONTH </option>";
		foreach ($mTmonths as $num => $name){echo "<option class='form-control_option' value='$num'>".$name."</option>";}
	}
	else{
		foreach ($mTmonths as $num => $name){
		if($num == $profileData['BirthMonth']){echo "<option class='form-control_option' value='$num' selected>".$name."</option>"; }
		else{ echo "<option class='form-control_option' value='$num'>".$name."</option>"; }
		}
	}
			echo "	
			</select>
			
			<select class='form-control_select' name='BirthYear' style='width:100px' >";		
			if($profileData['BirthYear'] == ''){				
				echo "<option class='form-control_option' value='' selected > YEAR </option>";			
				for ($x = 1950; $x <= 2005; $x++) { echo "<option class='form-control_option' value='$x'>$x</option>"; }
			}
			else{
				echo "<option class='form-control_option' value='".$profileData['BirthYear']."' selected>".$profileData['BirthYear']."</option>";
				for ($x = 1950; $x <= 2005; $x++) { echo "<option class='form-control_option' value='$x'>$x</option>"; }
			}
			echo "	
			</select>
			
			</td>
		</tr>
		
		<tr>
			<td style='border:0px;'>Title:</td>
			<td style='border:0px;'>
			<select class='form-control_select' name='Salutation''>";		
			if($profileData['Salutation'] == ''){				
				echo "<option class='form-control_option' value='' selected > SELECT YOUR SALUTATION </option>";
			}
			else{
				echo "<option class='form-control_option' value='".$profileData['Salutation']."' selected>".$profileData['Salutation']."</option>";
			}
			
			echo "
				<option class='form-control_option' value='Mr'>Mr</option>
				<option class='form-control_option' value='Mrs'>Mrs</option>
				<option class='form-control_option' value='Miss'>Miss</option>
				<option class='form-control_option' value='Dr'>Dr</option>
				<option class='form-control_option' value='Prof'>Prof</option>
			</select>
			</td>
		</tr>
		
		<tr>
			<td style='border:0px;'>Gender:</td>
			<td style='border:0px;'>
			<select class='form-control_select' name='Gender''>";		
			if($profileData['Gender'] == 'M'){				
				echo "
				<option class='form-control_option' value='M' selected >Male</option>
				<option class='form-control_option' value='F'>Female</option>";
			}
			elseif($profileData['Gender'] == 'F'){				
				echo "
				<option class='form-control_option' value='M' >Male</option>
				<option class='form-control_option' value='F' selected >Female</option>";
			}
			else{				
				echo "
				<option class='form-control_option' value='' selected > SELECT YOUR GENDER </option>
				<option class='form-control_option' value='M' >Male</option>
				<option class='form-control_option' value='F' >Female</option>";
			}
			
			echo "
			</select>
			</td>
		</tr>
		
		<tr>
			<td style='border:0px;'>Status:</td>
			<td style='border:0px;'>
			<select class='form-control_select' name='MarriedStatus''>";		
			if($profileData['MarriedStatus'] == 'S'){				
				echo "
				<option class='form-control_option' value='S' selected >Single</option>
				<option class='form-control_option' value='M'>Married</option>";
			}
			elseif($profileData['MarriedStatus'] == 'M'){				
				echo "
				<option class='form-control_option' value='S' >Single</option>
				<option class='form-control_option' value='M' selected >Married</option>";
			}
			else{				
				echo "
				<option class='form-control_option' value='' selected > SELECT YOUR STATUS </option>
				<option class='form-control_option' value='S' >Single</option>
				<option class='form-control_option' value='M' >Married</option>";
			}
			
			echo "
			</select>
			</td>
		</tr>

		<tr>
			<td style='border:0px;'>Job Position:</td>
			<td style='border:0px;'>
			<input type='text' name='JobPosition' class='form-control_text' value='".$profileData['JobPosition']."' />
			</td>
		</tr>
		<tr>
			<td style='border:0px;'>First Name:</td>
			<td style='border:0px;'>
			<input type='text' name='FirstName' class='form-control_text' value='".$profileData['FirstName']."' />
			</td>
		</tr>
		<tr>
			<td style='border:0px;'>Last Name:</td>
			<td style='border:0px;'>
			<input type='text' name='LastName' class='form-control_text' value='".$profileData['LastName']."' />
			</td>
		</tr>
		<tr>
			<td style='border:0px;'>SurName:</td>
			<td style='border:0px;'>
			<input type='text' name='SurName' class='form-control_text' value='".$profileData['SurName']."' />
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

