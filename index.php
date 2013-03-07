<?


$tuser = str_replace("\n",'',$_POST[tuser]);
$tpass = str_replace("\n",'',$_POST[tpass]);


$fuser = str_replace("\n",'',$_POST[fuser]);
$fpass = str_replace("\n",'',$_POST[fpass]);


$luser = str_replace("\n",'',$_POST[luser]);
$lpass = str_replace("\n",'',$_POST[lpass]);

if(empty($tuser)){ $tuser = "0";}
if(empty($tpass)){ $tpass = "0";}

if(empty($fuser)){ $fuser = "0";}
if(empty($fpass)){ $fpass = "0";}

if(empty($luser)){ $luser = "0";}
if(empty($lpass)){ $lpass = "0";}


include("functions.php");




$twitter = TwitterFollowers($tuser, $tpass);

$facebook = FacebookFriends($fuser, $fpass);

$linkedin = LinkedInConnections($luser, $lpass);

$tcount = GetGraphDataTwitter($tuser);

$fcount = GetGraphDataFacebook($fuser);

$lcount = GetGraphDataLinkedin($luser);

if(!empty($tcount)){

$tcountlist = implode(",", $tcount);

//$tcountlist = "-1|".$tcountlist."";

}

if(!empty($fcount)){

$fcountlist = implode(",", $fcount);

//$fcountlist = "-1|".$fcountlist."";

}

if(!empty($lcount)){

$lcountlist = implode(",", $lcount);

//$lcountlist = "-1|".$lcountlist."|";

}

$graphimg = "http://chart.apis.google.com/chart?chs=270x150&cht=lc&chtt=&chd=t:".$tcountlist."|".$lcountlist."&chco=41C0E4,3962C2,005E91&chxl=&chxt=";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
<!--
body {
	background:url("assets/bg.png");
	margin:0;
	width:100%;
}
#header {
	width:320px;
	height:60px;
	background:url("assets/headerbg.png");
	margin-left:auto;
	margin-right:auto;
	margin-bottom:30px;
}
.entrytw{
	display:block;
	background:url("assets/twitterblock.png");
	width:270px;
	height:113px;
	margin-bottom:15px;
	margin-left:auto;
	margin-right:auto;

}
.entryfb{
	display:block;
	background:url("assets/facebookblock.png");
	width:270px;
	height:113px;
	margin-bottom:15px;
	margin-left:auto;
	margin-right:auto;
}
.entryli{
	display:block;
	background:url("assets/linkedinblock.png");
	width:270px;
	height:113px;
	margin-bottom:15px;
	margin-left:auto;
	margin-right:auto;
	margin-top:30px;
}
.count{
	display:block;
	float:right;
	margin-right:12px;
	font-family:Georgia;
	font-style:italic;
	color:#efefef;
	font-size:24.6px;
	margin-top:75px;

}
.graphbox{
	display:block;
	width:270px;
	height:150px;
	margin-bottom:50px;
	margin-left:auto;
	margin-right:auto;
}
-->

</style>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
</head>

<body>
	<div class=entryli>
		<div class=count><?=$linkedin;?></div>
	</div>
	<div class=entryfb>
		<div class=count><?=$facebook;?></div>
	</div>
	<div class=entrytw>
		<div class=count><? print_r($twitter); ?></div>
	</div>
	<div class=graphbox>
		<img src=assets/graph_head.png><br>

		<? echo "<img src=\"$graphimg\">"; ?><br><br>

	</div>

</body>
</html>
