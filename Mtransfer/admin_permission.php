<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$permissionId = $_GET['id'];

//Check if selected permission level exists
if(!permissionIdExists($permissionId)){
	header("Location: admin_permissions.php"); die();	
}

$permissionDetails = fetchPermissionDetails($permissionId); //Fetch information specific to permission level

//Forms posted
if(!empty($_POST)){
	
	//Delete selected permission level
	if(!empty($_POST['delete'])){
		$deletions = $_POST['delete'];
		if ($deletion_count = deletePermission($deletions)){
		$successes[] = lang("PERMISSION_DELETIONS_SUCCESSFUL", array($deletion_count));
		}
		else {
			$errors[] = lang("SQL_ERROR");	
		}
	}
	else
	{
		//Update permission level name
		if($permissionDetails['name'] != $_POST['name']) {
			$permission = trim($_POST['name']);
			
			//Validate new name
			if (permissionNameExists($permission)){
				$errors[] = lang("ACCOUNT_PERMISSIONNAME_IN_USE", array($permission));
			}
			elseif (minMaxRange(1, 50, $permission)){
				$errors[] = lang("ACCOUNT_PERMISSION_CHAR_LIMIT", array(1, 50));	
			}
			else {
				if (updatePermissionName($permissionId, $permission)){
					$successes[] = lang("PERMISSION_NAME_UPDATE", array($permission));
				}
				else {
					$errors[] = lang("SQL_ERROR");
				}
			}
		}
		
		//Remove access to pages
		if(!empty($_POST['removePermission'])){
			$remove = $_POST['removePermission'];
			if ($deletion_count = removePermission($permissionId, $remove)) {
				$successes[] = lang("PERMISSION_REMOVE_USERS", array($deletion_count));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
		
		//Add access to pages
		if(!empty($_POST['addPermission'])){
			$add = $_POST['addPermission'];
			if ($addition_count = addPermission($permissionId, $add)) {
				$successes[] = lang("PERMISSION_ADD_USERS", array($addition_count));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
		
		//Remove access to pages
		if(!empty($_POST['removePage'])){
			$remove = $_POST['removePage'];
			if ($deletion_count = removePage($remove, $permissionId)) {
				$successes[] = lang("PERMISSION_REMOVE_PAGES", array($deletion_count));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
		
		//Add access to pages
		if(!empty($_POST['addPage'])){
			$add = $_POST['addPage'];
			if ($addition_count = addPage($add, $permissionId)) {
				$successes[] = lang("PERMISSION_ADD_PAGES", array($addition_count));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
			$permissionDetails = fetchPermissionDetails($permissionId);
	}
}

$pagePermissions = fetchPermissionPages($permissionId); //Retrieve list of accessible pages
$permissionUsers = fetchPermissionUsers($permissionId); //Retrieve list of users with membership
$userData = fetchAllUsers(); //Fetch all users
$pageData = fetchAllPages(); //Fetch all pages

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
                            <h2 class='mbr-header__text'>Admin Permission</h2>
                        </div>
                        <div data-form-alert='true'>";
						
                            echo resultBlock($errors,$successes);
	
                        echo "
						
						</div>
						
						
<form name='adminPermission' action='".$_SERVER['PHP_SELF']."?id=".$permissionId."' method='post'>
	<table class='admin mt_pagetableall'>
	
	<tr>
		<th><h3>Permission Information</h3></th>		
		<th><h3>Permission Membership</h3></th>		
		<th><h3>Permission Access</h3></th>
	</tr>
	
	<tr>
		<td class='mt_permission_tophead'>
		<div id='regbox'>
			<p><label>ID:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$permissionDetails['id']." </p></br>
			<p><label>Name:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='name' value='".$permissionDetails['name']."' /></p></br>
			<p><label>Delete:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='delete[".$permissionDetails['id']."]' id='delete[".$permissionDetails['id']."]' value='".$permissionDetails['id']."'></p>
		</div>
		</td>
		
		<td class='mt_permission_tophead'>
		<div id='regbox'>
		
			<p><b>Remove Members:</b>";
			//List users with permission level
			foreach ($userData as $v1) {
				if(isset($permissionUsers[$v1['id']])){echo "<br><input type='checkbox' name='removePermission[".$v1['id']."]' id='removePermission[".$v1['id']."]' value='".$v1['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$v1['display_name'];}
			}
			echo"
			</p>
	
			<p><b>Add Members:</b>";
			//List users without permission level
			foreach ($userData as $v1) {
				if(!isset($permissionUsers[$v1['id']])){echo "<br><input type='checkbox' name='addPermission[".$v1['id']."]' id='addPermission[".$v1['id']."]' value='".$v1['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$v1['display_name'];}
			}

			echo"
			</p>
		</div>
		</td>
		
		<td class='mt_permission_tophead'>
		<div id='regbox'>
			<p>
			<b>Public Access:</b>";
			//List public pages
			foreach ($pageData as $v1) {
				if($v1['private'] != 1){echo "<br>".$v1['page'];}
			}
			echo"
			</p>
			
			<p>
			<b>Remove Access:</b>";
			//List pages accessible to permission level
			foreach ($pageData as $v1) {
				if(isset($pagePermissions[$v1['id']]) AND $v1['private'] == 1){echo "<br><input type='checkbox' name='removePage[".$v1['id']."]' id='removePage[".$v1['id']."]' value='".$v1['id']."'> ".$v1['page'];}
			}
			echo"
			</p>
			
			<p>
			<b>Add Access:</b>";
			//List pages inaccessible to permission level
			foreach ($pageData as $v1) {
				if(!isset($pagePermissions[$v1['id']]) AND $v1['private'] == 1){echo "<br><input type='checkbox' name='addPage[".$v1['id']."]' id='addPage[".$v1['id']."]' value='".$v1['id']."'> ".$v1['page'];}
			}

			echo"
			</p>
		</div>
		</td>
	</tr>
	</table><br/>
	<p><input type='submit' value='UPDATE' class='mbr-buttons__btn btn btn-lg btn-primary' /></p>
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

