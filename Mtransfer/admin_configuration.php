<?php

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
	$cfgId = array();
	$newSettings = $_POST['settings'];
	
	//Validate new site name
	if ($newSettings[1] != $websiteName) {
		$newWebsiteName = $newSettings[1];
		if(minMaxRange(1,150,$newWebsiteName))
		{
			$errors[] = lang("CONFIG_NAME_CHAR_LIMIT",array(1,150));
		}
		else if (count($errors) == 0) {
			$cfgId[] = 1;
			$cfgValue[1] = $newWebsiteName;
			$websiteName = $newWebsiteName;
		}
	}
	
	//Validate new URL
	if ($newSettings[2] != $websiteUrl) {
		$newWebsiteUrl = $newSettings[2];
		if(minMaxRange(1,150,$newWebsiteUrl))
		{
			$errors[] = lang("CONFIG_URL_CHAR_LIMIT",array(1,150));
		}
		else if (substr($newWebsiteUrl, -1) != "/"){
			$errors[] = lang("CONFIG_INVALID_URL_END");
		}
		else if (count($errors) == 0) {
			$cfgId[] = 2;
			$cfgValue[2] = $newWebsiteUrl;
			$websiteUrl = $newWebsiteUrl;
		}
	}
	
	//Validate new site email address
	if ($newSettings[3] != $emailAddress) {
		$newEmail = $newSettings[3];
		if(minMaxRange(1,150,$newEmail))
		{
			$errors[] = lang("CONFIG_EMAIL_CHAR_LIMIT",array(1,150));
		}
		elseif(!isValidEmail($newEmail))
		{
			$errors[] = lang("CONFIG_EMAIL_INVALID");
		}
		else if (count($errors) == 0) {
			$cfgId[] = 3;
			$cfgValue[3] = $newEmail;
			$emailAddress = $newEmail;
		}
	}
	
	//Validate email activation selection
	if ($newSettings[4] != $emailActivation) {
		$newActivation = $newSettings[4];
		if($newActivation != "true" AND $newActivation != "false")
		{
			$errors[] = lang("CONFIG_ACTIVATION_TRUE_FALSE");
		}
		else if (count($errors) == 0) {
			$cfgId[] = 4;
			$cfgValue[4] = $newActivation;
			$emailActivation = $newActivation;
		}
	}
	
	//Validate new email activation resend threshold
	if ($newSettings[5] != $resend_activation_threshold) {
		$newResend_activation_threshold = $newSettings[5];
		if($newResend_activation_threshold > 72 OR $newResend_activation_threshold < 0)
		{
			$errors[] = lang("CONFIG_ACTIVATION_RESEND_RANGE",array(0,72));
		}
		else if (count($errors) == 0) {
			$cfgId[] = 5;
			$cfgValue[5] = $newResend_activation_threshold;
			$resend_activation_threshold = $newResend_activation_threshold;
		}
	}
	
	//Validate new language selection
	if ($newSettings[6] != $language) {
		$newLanguage = $newSettings[6];
		if(minMaxRange(1,150,$language))
		{
			$errors[] = lang("CONFIG_LANGUAGE_CHAR_LIMIT",array(1,150));
		}
		elseif (!file_exists($newLanguage)) {
			$errors[] = lang("CONFIG_LANGUAGE_INVALID",array($newLanguage));				
		}
		else if (count($errors) == 0) {
			$cfgId[] = 6;
			$cfgValue[6] = $newLanguage;
			$language = $newLanguage;
		}
	}
	
	//Validate new template selection
	if ($newSettings[7] != $template) {
		$newTemplate = $newSettings[7];
		if(minMaxRange(1,150,$template))
		{
			$errors[] = lang("CONFIG_TEMPLATE_CHAR_LIMIT",array(1,150));
		}
		elseif (!file_exists($newTemplate)) {
			$errors[] = lang("CONFIG_TEMPLATE_INVALID",array($newTemplate));				
		}
		else if (count($errors) == 0) {
			$cfgId[] = 7;
			$cfgValue[7] = $newTemplate;
			$template = $newTemplate;
		}
	}
	
	//Update configuration table with new settings
	if (count($errors) == 0 AND count($cfgId) > 0) {
		updateConfig($cfgId, $cfgValue);
		$successes[] = lang("CONFIG_UPDATE_SUCCESSFUL");
	}
}

$languages = getLanguageFiles(); //Retrieve list of language files
$templates = getTemplateFiles(); //Retrieve list of template files
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
                            <h2 class='mbr-header__text'>Admin Configuration</h2>
                        </div>
                        <div data-form-alert='true'>";
						
						
                            echo resultBlock($errors,$successes);
							
							
                        echo "
						
						</div>

<form name='adminConfiguration' action='".$_SERVER['PHP_SELF']."' method='post' data-form-title='Admin Configuration'>

<div class='form-group'>
	Enter Your Web Site Name:</br></br>
	<input type='text' name='settings[".$settings['website_name']['id']."]' value='".$websiteName."' class='form-control' required placeholder='Web Site Name' data-form-field='Name'>
</div>

<div class='form-group'>
	Enter Your Web Site Url:</br></br>
	<input type='text' name='settings[".$settings['website_url']['id']."]' value='".$websiteUrl."' class='form-control' required placeholder='Web Site Url' data-form-field='Name'>
</div>

<div class='form-group'>
	Enter Your Email Address:</br></br>
	<input type='text' name='settings[".$settings['email']['id']."]' value='".$emailAddress."' class='form-control' required placeholder='Email Address' data-form-field='Name'>
</div>

<div class='form-group'>
	Enter Your Resend Activation:</br></br>
	<input type='text' name='settings[".$settings['resend_activation_threshold']['id']."]' value='".$resend_activation_threshold."' class='form-control' required placeholder='Resend Activation' data-form-field='Name'>
</div>


<div class='form-group'>
	Enter Your Language:</br></br>
	<select class='form-control' data-form-field='Name' name='settings[".$settings['language']['id']."]'>";

//Display language options
foreach ($languages as $optLang){
	if ($optLang == $language){
		echo "<option value='".$optLang."' selected>$optLang</option>";
	}
	else {
		echo "<option value='".$optLang."'>$optLang</option>";
	}
}

echo "
</select>
</div>


<div class='form-group'>
	Enter Activation Throught Email:</br></br>
	<select class='form-control' data-form-field='Name' name='settings[".$settings['activation']['id']."]'>";

//Display email activation options
if ($emailActivation == "true"){
	echo "
	<option value='true' selected>True</option>
	<option value='false'>False</option>
	</select>";
}
else {
	echo "
	<option value='true'>True</option>
	<option value='false' selected>False</option>
	</select>";
}

echo "
</div>



<div class='mbr-buttons mbr-buttons--right'></br>
	<button type='submit' class='mbr-buttons__btn btn btn-lg btn-primary'>SAVE CONFIGURATION</button>
</div>


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
