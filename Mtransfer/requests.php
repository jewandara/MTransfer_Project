<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

//----------------------------------------------------------------------------
if ($loggedInUser->checkPermission(array(1))){ header("Location: unavailable.php"); }
//----------------------------------------------------------------------------

$UserId = $loggedInUser->user_id;

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
	if(!empty($_POST['delete'])){
		$deletions = $_POST['delete'];
		if ($deletion_count = deleteRequest($deletions)){
			$successes[] = lang("HOSPITAL_DELETIONS_SUCCESSFUL", array($deletion_count));
		}
	}
}

$requestData = fetchAllRequest($UserId);

if(empty($requestData)){ header("Location: request_new.php"); }

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
                            <h2 class='mbr-header__text'>User's Requests</h2>
                        </div>
                        <div data-form-alert='true'><div class='message_succ'>";
                            echo resultBlock($errors,$successes);
                        echo "
						</div>
							<br/>
							<a href='request_new.php' class='mbr-buttons__btn btn btn-lg btn-primary'> NEW REQUEST </a>
							<br/>
						</div>

			<div class='top_menu_items'>";
		
	echo "
		 </div>
		<br/>

		<form name='adminHospitals' action='".$_SERVER['PHP_SELF']."' method='post'>
			<table class='admin mt_pagetableall'>
				<tr>
					<th>Delete</th>
					<th>Requested Hospital</th>
					<th>Requested District</th>
					<th>Starting Requested Date</th>
					<th>Edit</th>
				</tr>";

			foreach ($requestData as $v1) {
			echo "
			<tr>
				<td><input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'></td>";
//----------------------------------------------------------------------------
				if($v1['batabaseType']=='H')
				{ 
					$DataBaseName = findHospitalName($v1['batabase_id']);
					echo "<td>".$DataBaseName['hospital']."</td>";
					$DataBaseName = null;
				 }
				elseif($v1['batabaseType']=='S')
				{
					$DataBaseName = findHospitalName($v1['batabase_id']);
					echo "<td>".$DataBaseName['hospital']."</td>";
					$DataBaseName = null;
				}
				else{ echo "<td></td>"; }
//----------------------------------------------------------------------------
				foreach ($districData as $v2)
				{ 
					if ( $v1['district_id'] == $v2['id'] ) 
					{  echo "<td><a href='".$v2['description']."' target='_blank' >".$v2['district']."</a></td>"; } 
				}
//----------------------------------------------------------------------------
				foreach ($mTmonths as $num => $name) 
				{ 
				 	 if ( $v1['request_start_month'] == $num )
				  	{  echo "<td>  ".$name."  in  ".$v1['request_start_year']."</td>"; }
				}
//----------------------------------------------------------------------------
			echo "<td>				  
					<div style='width:12px;'>
						<a href='request.php?id=".$v1['id']."'><img src='assets/images/edit.png' width='24'/></a>
				   	</div>
				  </td>
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
