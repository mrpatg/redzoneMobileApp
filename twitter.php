<?

$username = $tuser;

$rawxml = file_get_contents("http://api.twitter.com/1/users/show.xml?screen_name=$username");

$xml = simplexml_load_string($rawxml);

$count = $xml->{"followers_count"};

echo $count;

?>