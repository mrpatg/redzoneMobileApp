<?
$dbuser = "orbitrne_redzapi";
$dbpass = "orbitrne_redzapi";
$dbname = "orbitrne_redzapi";
$dbsrvr = "localhost";
$link = mysql_connect($dbsrvr, $dbuser, $dbpass);
if (!$link) {
    die('Not connected : ' . mysql_error());}
if (! mysql_select_db($dbname) ) {
    die ('Can\'t use $dbname : ' . mysql_error());
}
?>