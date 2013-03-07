<?
include("functions.php");


if(isset($_POST[tuser]) && isset($_POST[tpass])){

	$tuser = $_POST[tuser];

	$tpass = $_POST[tpass];

	if(TwitterCheck($tuser, $tpass)){
	
		$twitter = TwitterFollowers($tuser, $tpass);

		$tlogin = array($tuser, $tpass);

		$tlogin = serialize($tlogin);

		$twomonths = 60 * 60 * 24 * 60 + time(); 
		setcookie('tlogin', $tlogin, $twomonths);

		echo $twitter;
	
		$tcount = GetGraphDataTwitter($tuser);
	
		if(!empty($tcount)){
		
			$tcountlist = implode(",", $tcount);
			
			$tcountlist = "-1|".$tcountlist."";
		
		}

	
	}

}

if(isset($_POST[luser]) && isset($_POST[lpass])){

	$luser = $_POST[luser];

	$lpass = $_POST[lpass];

	$linkedin = LinkedInConnections($luser, $lpass);

	$lcount = GetGraphDataLinkedin($luser);

		$llogin = array($luser, $lpass);

		$llogin = serialize($llogin);

		$twomonths = 60 * 60 * 24 * 60 + time(); 
		setcookie('llogin', $llogin, $twomonths);


	echo $linkedin;

	if(!empty($lcount)){
	
	$lcountlist = implode(",", $lcount);
	
	$lcountlist = "-1|".$lcountlist."|";
	
	}

}


if(isset($_POST[fuser]) && isset($_POST[fpass])){

	$fuser = $_POST[fuser];

	$fpass = $_POST[fpass];

		$flogin = array($fuser, $fpass);

		$flogin = serialize($flogin);

		$twomonths = 60 * 60 * 24 * 60 + time(); 
		setcookie('flogin', $flogin, $twomonths);


}
// print_r($_POST);
?>