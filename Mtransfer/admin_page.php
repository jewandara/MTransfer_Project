<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$pageId = $_GET['id'];

//Check if selected pages exist
if(!pageIdExists($pageId)){
	header("Location: admin_pages.php"); die();	
}

$pageDetails = fetchPageDetails($pageId); //Fetch information specific to page

//Forms posted
if(!empty($_POST)){
	$update = 0;
	
	if(!empty($_POST['private'])){ $private = $_POST['private']; }
	
	//Toggle private page setting
	if (isset($private) AND $private == 'Yes'){
		if ($pageDetails['private'] == 0){
			if (updatePrivate($pageId, 1)){
				$successes[] = lang("PAGE_PRIVATE_TOGGLED", array("private"));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
	}
	elseif ($pageDetails['private'] == 1){
		if (updatePrivate($pageId, 0)){
			$successes[] = lang("PAGE_PRIVATE_TOGGLED", array("public"));
		}
		else {
			$errors[] = lang("SQL_ERROR");	
		}
	}
	
	//Remove permission level(s) access to page
	if(!empty($_POST['removePermission'])){
		$remove = $_POST['removePermission'];
		if ($deletion_count = removePage($pageId, $remove)){
			$successes[] = lang("PAGE_ACCESS_REMOVED", array($deletion_count));
		}
		else {
			$errors[] = lang("SQL_ERROR");	
		}
		
	}
	
	//Add permission level(s) access to page
	if(!empty($_POST['addPermission'])){
		$add = $_POST['addPermission'];
		if ($addition_count = addPage($pageId, $add)){
			$successes[] = lang("PAGE_ACCESS_ADDED", array($addition_count));
		}
		else {
			$errors[] = lang("SQL_ERROR");	
		}
	}
	
	$pageDetails = fetchPageDetails($pageId);
}

$pagePermissions = fetchPagePermissions($pageId);
$permissionData = fetchAllPermissions();

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
                            <h2 class='mbr-header__text'>Admin Pages</h2>
                        </div>
                        <div data-form-alert='true'>";
						
						
                            echo resultBlock($errors,$successes);
							
							
                        echo "
						
						</div>

<form name='adminPage' action='".$_SERVER['PHP_SELF']."?id=".$pageId."' method='post'>

<input type='hidden' name='process' value='1'>
<table class='admin' width='100%'>

<tr>
	<th><h3>Page Information</h3></th>
	<th><h3>Page Access</h3></th>
<tr>

<tr>
	<td class='mt_pagetable'>
		<div id='regbox'>
		<p><label>ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>".$pageDetails['id']."</p>
		<p><label>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>".$pageDetails['page']."</p>
		<p>
			<label>Private:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>";
			//Display private checkbox
			if ($pageDetails['private'] == 1){ echo "<input type='checkbox' name='private' id='private' value='Yes' checked>"; }
			else { echo "<input type='checkbox' name='private' id='private' value='Yes'>"; }
			echo "
		</p>
	</div>
	</td>
	
	<td class='mt_pagetable'>
		<div id='regbox'>
		<p><b>Remove Access:</b>";
	//Display list of permission levels with access
		foreach ($permissionData as $v1) {
		if(isset($pagePermissions[$v1['id']])){ echo "<br><input type='checkbox' name='removePermission[".$v1['id']."]' id='removePermission[".$v1['id']."]' value='".$v1['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$v1['name']; }
		}
		echo"
		</p>
		<p><b>Add Access:</b>";
			//Display list of permission levels without access
			foreach ($permissionData as $v1) {
			if(!isset($pagePermissions[$v1['id']])){ echo "<br><input type='checkbox' name='addPermission[".$v1['id']."]' id='addPermission[".$v1['id']."]' value='".$v1['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$v1['name']; }
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
