<?

include("simple_html_dom.php");

function SaveToDB($username, $service, $count){

	include("dbconn.php");
	
	$sql = "INSERT INTO `logs` ( `user` ,  `service` ,  `count`) VALUES(  '{$username}' ,  '{$service}' ,  '{$count}') "; 
	mysql_query($sql) or die(mysql_error()); 

}



function TwitterCheck($tuser, $tpass){

	$rawxml = file_get_contents("https://$tuser:$tpass@api.twitter.com/1/account/verify_credentials.xml");

	if(!$rawxml){
		return FALSE;
	}else{
		return TRUE;
	}

}



function TwitterFollowers($tuser, $tpass){
	
	$username = $tuser;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://www.twitter.com/'.$tuser);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
		$pagetext = curl_exec($ch);
		curl_exec($ch);

		$html = new simple_html_dom();
		$html->load($pagetext);
		
		$link = $html->find('span[id=follower_count]', 0)->plaintext;

		$count = $link;

	
//	$rawxml = file_get_contents("http://$tuser:$tpass@api.twitter.com/1/users/show.xml?screen_name=$username");
	
//	$xml = simplexml_load_string($rawxml);
	
//	$count = $xml->{"followers_count"};

	$count = trim($count);

	SaveToDB($tuser, "twitter", $count);
	
	return $count;

}



function LinkedInConnections($luser, $lpass){

	$username = $luser;
	
	$pagetext = @file_get_contents("http://www.linkedin.com/in/$username");
	
	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
	//		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	//		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3');
			curl_setopt($ch, CURLOPT_FILETIME, 1);
	//		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		    curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_URL, "http://www.linkedin.com/in/$username");
	//		$pagetext = curl_exec($ch);
			curl_close($ch);
	
	
	$html = new simple_html_dom();
	$html->load($pagetext);
	
	$count = $html->find('.connection-count', 0)->plaintext;

	$count = trim($count);

	SaveToDB($luser, "linkedin", $count);

	return $count;

}



function FacebookFriends($fuser, $fpass){

	$login_email = $fuser;
	$login_pass = $fpass;

	$ckfile = tempnam ("/tmp", "CURLCOOKIE");
	

	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://login.facebook.com/login.php?m&next=http://m.facebook.com/friends.php?rff75e0b2&a&refid=5');
		curl_setopt($ch, CURLOPT_POSTFIELDS,'email='.urlencode($login_email).'&pass='.urlencode($login_pass).'&login=Login');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
		$pagetext = curl_exec($ch);
		curl_exec($ch);
	
	
	
	$html = new simple_html_dom();
	$html->load($pagetext);
	
	$link = $html->find('a[accesskey=6]', 0);
	
	
	
	
	  $re1='.*?';	# Non-greedy match on filler
	  $re2='(?:[a-z][a-z0-9_]*)';	# Uninteresting: var
	  $re3='.*?';	# Non-greedy match on filler
	  $re4='(?:[a-z][a-z0-9_]*)';	# Uninteresting: var
	  $re5='.*?';	# Non-greedy match on filler
	  $re6='(?:[a-z][a-z0-9_]*)';	# Uninteresting: var
	  $re7='.*?';	# Non-greedy match on filler
	  $re8='(?:[a-z][a-z0-9_]*)';	# Uninteresting: var
	  $re9='.*?';	# Non-greedy match on filler
	  $re10='((?:[a-z][a-z0-9_]*))';	# Variable Name 1
	
	  if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8.$re9.$re10."/is", $link, $matches))
	  {
	      $target=$matches[1][0];
	  }
	
	
	
	/* STEP 3. visit cookiepage.php */
	$ch = curl_init ("http://m.facebook.com/friends.php?$target&a&refid=5");
	curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec ($ch);
	
	
	
	
	
	
	
	
	 $txt= $output;
	
	  $re1='.*?';	# Non-greedy match on filler
	  $re2='\\d+';	# Uninteresting: int
	  $re3='.*?';	# Non-greedy match on filler
	  $re4='\\d+';	# Uninteresting: int
	  $re5='.*?';	# Non-greedy match on filler
	  $re6='(\\d+)';	# Integer Number 1
	  $re7='(\\s+)';	# White Space 1
	  $re8='(friends)';	# Word 1
	
	  if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8."/is", $txt, $matches))
	  {
	      $count=$matches[1][0];
	      $ws1=$matches[2][0];
	      $word1=$matches[3][0];
	  }

//	SaveToDB($fuser, "facebook", $count);

	return $count;

}


function GetGraphDataTwitter($tuser){

	include("dbconn.php");

	$result = mysql_query("SELECT `count` FROM `logs` WHERE `user` = '$tuser' AND `service` = 'twitter' ORDER BY `time` DESC LIMIT 30 ") or die(mysql_error());
	while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
	$count = $row['count'];
	$countarray[] = $count;
	}

	return $countarray;

}



function GetGraphDataFacebook($fuser){

	include("dbconn.php");

	$result = mysql_query("SELECT `count` FROM `logs` WHERE `user` = '$fuser' AND `service` = 'facebook' ORDER BY `time` DESC LIMIT 30 ") or die(mysql_error());
	while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
	$count = $row['count'];
	$countarray[] = $count;
	}

	return $countarray;

}



function GetGraphDataLinkedin($luser){

	include("dbconn.php");

	$result = mysql_query("SELECT `count` FROM `logs` WHERE `user` = '$luser' AND `service` = 'linkedin' ORDER BY `time` DESC LIMIT 30 ") or die(mysql_error());
	while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
	$count = $row['count'];
	$countarray[] = $count;
	}

	return $countarray;


}



?>