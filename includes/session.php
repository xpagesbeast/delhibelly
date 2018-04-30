<?php
	session_start(); 
	$user_name = "CS-319";
	$is_admin = false;
	
	if (isset($_SESSION['user_id'])) {
		$user_name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
		
		if(isset($_SESSION['user_type_id']) && $_SESSION['user_type_id'] == 3) {
			$is_admin = true;
		}
	}

	/*When the page is loaded, checks to see if the session is set.  By default shows the home.  Highlights the location in the banner*/
	if(!isset($_SESSION['active_nav_tab'])){
       // highLightNavigationTab('home');
    }

function highLightNavigationTab($newValue){
    $_SESSION['active_nav_tab'] = $newValue;
}

?>