<?


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
	      $int1=$matches[1][0];
	      $ws1=$matches[2][0];
	      $word1=$matches[3][0];
	  }


	return $int1;

}





?>