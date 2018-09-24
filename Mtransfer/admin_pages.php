<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

$pages = getPageFiles(); //Retrieve list of pages in root usercake folder
$dbpages = fetchAllPages(); //Retrieve list of pages in pages table
$creations = array();
$deletions = array();

//Check if any pages exist which are not in DB
foreach ($pages as $page){
	if(!isset($dbpages[$page])){
		$creations[] = $page;	
	}
}

//Enter new pages in DB if found
if (count($creations) > 0) {
	createPages($creations)	;
}

if (count($dbpages) > 0){
	//Check if DB contains pages that don't exist
	foreach ($dbpages as $page){
		if(!isset($pages[$page['page']])){
			$deletions[] = $page['id'];	
		}
	}
}

//Delete pages from DB if not found
if (count($deletions) > 0) {
	deletePages($deletions);
}

//Update DB pages
$dbpages = fetchAllPages();

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

<table class='admin mt_pagetableall'>
	<tr>
		<th >Id</th>
		<th >Page</th>
		<th >Access</th>
	</tr>";

	//Display list of pages
	foreach ($dbpages as $page){
	echo "
	<tr>
		<td>".$page['id']."</td>
		<td><a href ='admin_page.php?id=".$page['id']."'>".$page['page']."</a></td>
		<td>";
			//Show public/private setting of page
			if($page['private'] == 0){echo "Public";}
			else {echo "Private";}
		echo "
		</td>
	</tr>";
	}

	echo "
</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
";

require_once("models/footer.php");

?>
