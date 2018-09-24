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

$disId = $_GET['did'];

if(!districtIdExists($disId)){ header("Location: transfers.php?did=8"); }

$hospitalData = fetchAllHospital($disId);

$districData = fetchAllDistrict(); 
$selectetDistricName = ''; 

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
                            <h2 class='mbr-header__text'>User Requesting Hospitals</h2>
                        </div>
                        <div data-form-alert='true'><div class='message_succ'>";

                            echo resultBlock($errors,$successes);
							
                        echo "
						
						</div></div>

			<div class='top_menu_items'>";
	foreach ($districData as $oV)
	{ 
	if($oV['id'] == $disId)
	{ 
		echo "<a href='transfers.php?did=".$oV['id']."' class='form-control_menu_select'>".$oV['district']."</a>";
		$selectetDistricName = $oV['district'];
	}
	else{ echo "<a href='transfers.php?did=".$oV['id']."' class='form-control_menu'>".$oV['district']."</a>"; }
	}		
	echo "
		 </div>
		<br/>
			
			<table class='admin mt_pagetableall'>
				<tr>					
					<th>ID</th>
					<th>Wanted Hospitl Name</th>
					<th>Requesting Date</th>
					<th>View User</th>
				</tr>";
			$count = 1;
			foreach ($hospitalData as $v1) 
			{
				if (requestDistrictIdExists($disId))
				 {
					$requestData = fetchAllRequestByDistrict($disId);
					foreach ($requestData as $oV)
					{ 				
						if ($v1['id'] == $oV['batabase_id'])
				 		{
							echo "
							<tr>
								<td>".$count."</td>
								<td>".$v1['type'].", ".$v1['hospital']." in ".$selectetDistricName."</td>
								<td>". $mTmonths[$oV['request_start_month']]." of ".$oV['request_start_year']."</td>
								<td><a href='users.php?id=".$oV['user_id']."' target='_blank' >view user</a></td>
							</tr>";
							$count = $count + 1;
						}
					}
					$requestData = null;
				}
			}

			echo "
			</table>
			
			
					<p><br/></p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

";

require_once("models/footer.php");


?>
