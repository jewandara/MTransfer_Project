<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
	//Delete permission levels
	if(!empty($_POST['delete'])){
		$deletions = $_POST['delete'];
		if ($deletion_count = deletePermission($deletions)){
		$successes[] = lang("PERMISSION_DELETIONS_SUCCESSFUL", array($deletion_count));
		}
	}
	
	//Create new permission level
	if(!empty($_POST['newPermission'])) {
		$permission = trim($_POST['newPermission']);
		
		//Validate request
		if (permissionNameExists($permission)){
			$errors[] = lang("PERMISSION_NAME_IN_USE", array($permission));
		}
		elseif (minMaxRange(1, 50, $permission)){
			$errors[] = lang("PERMISSION_CHAR_LIMIT", array(1, 50));	
		}
		else{
			if (createPermission($permission)) {
			$successes[] = lang("PERMISSION_CREATION_SUCCESSFUL", array($permission));
		}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
	}
}

$permissionData = fetchAllPermissions(); //Retrieve list of all permission levels


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
                            <h2 class='mbr-header__text'>Admin Permissions</h2>
                        </div>
                        <div data-form-alert='true'>";
						
						
                            echo resultBlock($errors,$successes);
							
							
                        echo "
						
						</div>

		<form name='adminPermissions' action='".$_SERVER['PHP_SELF']."' method='post'>
			<table class='admin mt_pagetableall'>
				<tr>
					<th>Delete</th>
					<th>Permission Name</th>
				</tr>";

			//List each permission level
			foreach ($permissionData as $v1) {
			echo "
			<tr>
				<td><input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'></td>
				<td><a href='admin_permission.php?id=".$v1['id']."'>".$v1['name']."</a></td>
			</tr>";
			}

			echo "
			</table><br/>
			<p>
				<label>Permission Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<input type='text' name='newPermission' style='width:350px;'/>
			</p>                                
			<br/><input type='submit' name='Submit' value='SUBMIT' class='mbr-buttons__btn btn btn-lg btn-primary'/>
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
