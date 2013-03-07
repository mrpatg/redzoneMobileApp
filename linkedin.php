<?

include("simple_html_dom.php");



$username = $luser;

$username = $_GET[username];


 $pagetext = file_get_contents("http://www.linkedin.com/in/".$username);


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3');
		curl_setopt($ch, CURLOPT_FILETIME, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_URL, "http://www.linkedin.com/in/".$username);
//		$pagetext = curl_exec($ch);
		curl_close($ch);


$html = new simple_html_dom();
$html->load($pagetext);

$count = $html->find('.connection-count', 0)->plaintext;

echo $count;

//echo $pagetext;


?>