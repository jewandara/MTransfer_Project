<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

//----------------------------------------------------------------------------
if ($loggedInUser->checkPermission(array(1))){ header("Location: unavailable.php"); }
//----------------------------------------------------------------------------

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

if(!empty($_POST))
{
	if(!empty($_POST['DistrictID'])) 
	{
		$DistrictID = $_POST['DistrictID'];
		header("Location: request_new.php?did=".$DistrictID);
	}
	elseif(empty($_POST['DistrictID'])) 
	{ $errors[] = 'Please, Select Your Transfering District'; }
	
	
	if(isset($_GET['did'])) 
	{
		if ($loggedInUser->checkPermission(array(1))){ $DBUserType = 'S'; }
		if ($loggedInUser->checkPermission(array(3))){ $DBUserType = 'H'; }
	
		$UserId = $loggedInUser->user_id;
		if(createRequest($UserId, $_GET['did'], $DBUserType, $_POST['location'], $_POST['StartYear'], $_POST['StartMonth'], $_POST['EndYear'], $_POST['EndMonth'], $_POST['Reason']))
		{
			$successes[] = lang("HOSPITAL_CREATION_SUCCESSFUL", array($UserId));
			header("Location: requests.php"); die();
		}
		else { $errors[] = lang("SQL_ERROR"); }
	}
}



require_once("models/header.php");

include("left-nav.php");

echo "

<section class='mbr-section mbr-section--relative mbr-section--fixed-size mbr-parallax-background mbr-after-navbar' id='form1-48' style='background-image: url(assets/images/wallttt-1200x720-27.png);'>
    
    <div class='mbr-section__container mbr-section__container--std-padding container'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='row'>
                    <div class='col-sm-8 col-sm-offset-2' data-form-type='formoid'>";
						
	if(!isset($_GET['did']))
	{ 
		$districData = fetchAllDistrict(); 
		echo "
		<div class='mbr-header mbr-header--center mbr-header--std-padding'>
            <h2 class='mbr-header__text'>Select Transferring District</h2>
        </div>
        <div data-form-alert='true'><div class='message_succ'>";
            echo resultBlock($errors,$successes);				
        echo "
		</div></div>
		<form name='newRequestID' action='".$_SERVER['PHP_SELF']."' method='post'>
				<table>
				<tr>
					<td style='border:0px;'>
						<select class='form-control_select' name='DistrictID''>
							<option class='form-control_option'  value='' selected> SELECT DISTRICT </option>";
						foreach ($districData as $oV)
						{ echo "<option class='form-control_option' value='".$oV['id']."'>".$oV['district']."</option>"; }
						echo "
						</select>
						<br/><br/><br/>
					    <input type='submit' name='Submit' value=' REQUEST ' class='mbr-buttons__btn btn btn-lg btn-primary'/>
					</td>
				</tr>
			</table>
		</form>";
	}
	else 
	{ 
		$hospitalData = fetchAllHospital($_GET['did']);
		echo "
		<div class='mbr-header mbr-header--center mbr-header--std-padding'>
            <h2 class='mbr-header__text'>Requesting Hospital Informations</h2>
        </div>
        <div data-form-alert='true'><div class='message_succ'>";
            echo resultBlock($errors,$successes);				
        echo "
		</div></div>
		<form name='Request' action='".$_SERVER['PHP_SELF']."?did=".$_GET['did']."' method='post'>
			<table>
				<tr>
					<td style='border:0px;'>
						Requseting Location
					</td>
					<td style='border:0px;'>
			<select class='form-control_select' name='location'>";
			if(isset($_GET['hid'])) 
			{
				foreach ($hospitalData as $v1)
				{
					if($_GET['hid'] == $v1['id'])
					{ echo "<option class='form-control_option' value='".$v1['id']."' selected>".$v1['hospital']."</option>"; }	
					echo "<option class='form-control_option' value='".$v1['id']."'>".$v1['hospital']."</option>";
				}
			}
			else
			{
				foreach ($hospitalData as $v1)
				{ echo "<option class='form-control_option' value='".$v1['id']."'>".$v1['hospital']."</option>"; }
				 echo "<option class='form-control_option' value='' selected > SELECT LOCATION </option>";
			}
			echo "	
			</select>
					</td>
				</tr>
						
				<tr>
					<td style='border:0px;'>									
						Requset Starting Date
					</td>
					<td style='border:0px;'>

			<select class='form-control_select' name='StartMonth' style='width:150px' >
				<option class='form-control_option' value='' selected > MONTH </option>";
				foreach ($mTmonths as $num => $name){echo "<option class='form-control_option' value='$num'>".$name."</option>";}
			echo "	
			</select>
			
			<select class='form-control_select' name='StartYear' style='width:120px' >
				<option class='form-control_option' value='' selected > YEAR </option>";			
				for ($x = date('Y'); $x <= date('Y')+20; $x++) { echo "<option class='form-control_option' value='$x'>$x</option>"; }
			echo "	
			</select>
			
					</td>
				</tr>
						
				<tr>
					<td style='border:0px;'>									
						Requset Ending Date
					</td>
					<td style='border:0px;'>

			<select class='form-control_select' name='EndMonth' style='width:150px' >
				<option class='form-control_option' value='' selected > MONTH </option>";
				foreach ($mTmonths as $num => $name){echo "<option class='form-control_option' value='$num'>".$name."</option>";}
			echo "	
			</select>
			
			<select class='form-control_select' name='EndYear' style='width:120px' >
				<option class='form-control_option' value='' selected > YEAR </option>";			
				for ($x = date('Y'); $x <= date('Y')+20; $x++) { echo "<option class='form-control_option' value='$x'>$x</option>"; }
			echo "	
			</select>
			
					</td>
				</tr>
	
				<tr>
					<td style='border:0px;'>									
						Reason for Location
					</td>
					<td style='border:0px;'>
						<input type='text' name='Reason' class='form-control_text' required placeholder='Reason'/>
					</td>
				</tr>

				<tr>
					<td style='border:0px;'>
						<input type='submit' name='Submit' value='COMPLETE REQUEST' class='mbr-buttons__btn btn btn-lg btn-primary'/>
					</td>
					<td style='border:0px;'></td>
				</tr>
				
			</table>
		</form>";
	}
		
		
					echo "
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
