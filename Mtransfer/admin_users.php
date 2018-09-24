<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
	$deletions = $_POST['delete'];
	if ($deletion_count = deleteUsers($deletions)){
		$successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
	}
	else {
		$errors[] = lang("SQL_ERROR");
	}
}

$userData = fetchAllUsers(); //Fetch information for all users


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
                            <h2 class='mbr-header__text'>Regisestered Users</h2>
                        </div>
                        <div data-form-alert='true'>";
						
                            echo resultBlock($errors,$successes);
	
                        echo "
						
						</div>

<form name='adminUsers' action='".$_SERVER['PHP_SELF']."' method='post'>
	<table class='admin'>
	<tr>
		<th>Delete</th>
		<th>User Email Address</th>
		<th>User ID</th>
		<th>User Type</th>
		<th>Last Login Date</th>
	</tr>";

	//Cycle through users
	foreach ($userData as $v1) {
	echo "
	<tr>
		<td><input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'></td>
		<td><a href='admin_user.php?id=".$v1['id']."'>".$v1['user_name']."</a></td>
		<td>".$v1['display_name']."</td>
		<td>".$v1['title']."</td>
		<td>";
			//Interprety last login
			if ($v1['last_sign_in_stamp'] == '0'){echo "Never";}
			else {echo date("j M, Y", $v1['last_sign_in_stamp']);}
			echo "
		</td>
	</tr>";
	}

	echo "
	</table><br/>
	<input type='submit' name='Submit' value='DELETE' class='mbr-buttons__btn btn btn-lg btn-primary' />
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
