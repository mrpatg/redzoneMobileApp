<?


include("simple_html_dom.php");

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://www.twitter.com/mrpatg');
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

		echo $count;

?>