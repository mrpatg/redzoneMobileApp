<?

include("functions.php");

if(isset($_COOKIE[tlogin])){

	$tlogin = unserialize($_COOKIE[tlogin]);
	$tuser = $tlogin[0];
	$tpass = $tlogin[1];
	
	$twitter = TwitterFollowers($tuser, $tpass);
	
}else{

	$tloginform = "		<div id=twlogin>
				<form method=post>
					<input type=text value=username id=tuser>
					<input type=text value=password id=tpass>
					<input type=submit value=login class=tsubmit>
				</form>
			</div>
			<div id=loading></div>";

}

if(isset($_COOKIE[flogin])){

	$flogin = unserialize($_COOKIE[flogin]);
	$fuser = $flogin[0];
	$fpass = $flogin[1];
	
	$facebook = FacebookFriends($fuser, $fpass);
	
}else{

	$floginform = "		<div id=flogin>
				<form method=post>
					<input type=text value=username id=fuser>
					<input type=text value=password id=fpass>
					<input type=submit value=login class=fsubmit>
				</form>
			</div>
			<div id=floading></div>";

}

if(isset($_COOKIE[llogin])){

	$llogin = unserialize($_COOKIE[llogin]);
	$luser = $llogin[0];
	$lpass = $llogin[1];
	
	$linkedin = LinkedInConnections($luser, $lpass);
	
}else{

	$lloginform = "		<div id=llogin>
				<form method=post>
					<input type=text value=username id=luser>
					<input type=text value=password id=lpass>
					<input type=submit value=login class=lsubmit>
				</form>
			</div>
			<div id=lloading></div>";

}

$tuser = str_replace("\n",'',$_POST[tuser]);
$tpass = str_replace("\n",'',$_POST[tpass]);


$fuser = str_replace("\n",'',$_POST[fuser]);
$fpass = str_replace("\n",'',$_POST[fpass]);


$luser = str_replace("\n",'',$_POST[luser]);
$lpass = str_replace("\n",'',$_POST[lpass]);




/* DEMO MODE */
if(empty($_POST)){
	$tuser = "mrpatg";
	$tpass = "BEEFbeef01";
	$luser = "mrpatg";
	$fuser = "mrpatg@gmail.com";
	$fpass = "tecton";
}

//$twitter = TwitterFollowers($tuser, $tpass);

//$facebook = FacebookFriends($fuser, $fpass);

//$linkedin = LinkedInConnections($luser, $lpass);

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

$graphimg = "http://chart.apis.google.com/chart?chs=320x150&cht=lc&chtt=&chd=t:".$tcountlist."|".$lcountlist."&chco=41C0E4,3962C2,005E91&chxl=&chxt=";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
<!--
body {
	background:url("assets/bg.png");
	margin:0;
	width:320px;
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
	background:url("assets/twitterblockbb.jpg") no-repeat;
	width:320px;
	height:123px;
	margin-bottom:15px;
	margin-left:auto;
	margin-right:auto;

}
#loading{
	color:#fff;
	font-family:Georgia;
	font-style:italic;
	position:relative;
	top:60px;
	width:270px;
	display:inline-block;
	text-align:center;
}
#twlogin{
	color:#fff;
	font-family:Georgia;
	font-style:italic;
	position:relative;
	top:63px;
	width:320px;
	display:inline-block;
	text-align:center;
}
#twlogin input{
	width:75px;
	display:inline-block;
	margin-left:auto;
	margin-right:auto;
	font-family:Georgia;
	font-style:italic;
}
#floading{
	color:#fff;
	font-family:Georgia;
	font-style:italic;
	position:relative;
	top:60px;
	width:270px;
	display:inline-block;
	text-align:center;
}
#flogin{
	color:#fff;
	font-family:Georgia;
	font-style:italic;
	position:relative;
	top:63px;
	width:320px;
	display:inline-block;
	text-align:center;
}
#flogin input{
	width:75px;
	display:inline-block;
	margin-left:auto;
	margin-right:auto;
	font-family:Georgia;
	font-style:italic;
}
#lloading{
	color:#fff;
	font-family:Georgia;
	font-style:italic;
	position:relative;
	top:60px;
	width:270px;
	display:inline-block;
	text-align:center;
}
#llogin{
	color:#fff;
	font-family:Georgia;
	font-style:italic;
	position:relative;
	top:63px;
	width:320px;
	display:inline-block;
	text-align:center;
}
#llogin input{
	width:75px;
	display:inline-block;
	margin-left:auto;
	margin-right:auto;
	font-family:Georgia;
	font-style:italic;
}
.entryfb{
	display:block;
	background:url("assets/facebookblockbb.jpg");
	width:320px;
	height:113px;
	margin-bottom:15px;
	margin-left:auto;
	margin-right:auto;
}
.entryli{
	display:block;
	background:url("assets/linkedinblockbb.jpg");
	width:320px;
	height:113px;
	margin-bottom:15px;
	margin-left:auto;
	margin-right:auto;
	margin-top:30px;
}
.lcount{
	display:block;
	float:right;
	margin-right:12px;
	font-family:Georgia;
	font-style:italic;
	color:#efefef;
	font-size:24.6px;
	margin-top:75px;

}
.fcount{
	display:block;
	float:right;
	margin-right:12px;
	font-family:Georgia;
	font-style:italic;
	color:#efefef;
	font-size:24.6px;
	margin-top:75px;

}
.tcount{
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
	width:320px;
	height:150px;
	margin-bottom:50px;
	margin-left:auto;
	margin-right:auto;
}
#overlay{
	background:url('assets/connectors_splash.png');
	height:480px;
	width:320px;
	position:absolute;
	display:block;
	margin-left:auto;
	margin-right:auto;
	z-index:300;
}
#content{
	margin-left:auto;
	margin-right:auto;
	width:320px;
	margin-bottom:40px;
}
#footermenu{
	display:block;
	width:320px;
	margin-left:auto;
	margin-right:auto;
	height:48px;
	background:url('assets/bb_footerbg.png') repeat-x;
	position:fixed;
	bottom:0px;
}
.connections{
	display:inline-block;
	float:left;
	height:44px;
	width:64px;
	background:url('assets/connections_off.png') no-repeat;
}
.connections:hover{
	background:url('assets/connections_on.png') no-repeat;
}
.blog{
	display:inline-block;
	float:left;
	height:44px;
	width:64px;
	background:url('assets/blog_off.png') no-repeat;
}
.blog:hover{
	background:url('assets/blog_on.png') no-repeat;
}
.tips{
	display:inline-block;
	float:left;
	height:44px;
	width:64px;
	background:url('assets/tips_off.png') no-repeat;
}
.tips:hover{
	background:url('assets/tips_on.png') no-repeat;
}
.audible{
	display:inline-block;
	float:left;
	height:44px;
	width:64px;
	background:url('assets/audible_off.png') no-repeat;
}
.audible:hover{
	background:url('assets/audible_on.png') no-repeat;
}
.logout{
	display:inline-block;
	float:left;
	height:44px;
	width:64px;
	background:url('assets/logout_off.png') no-repeat;
}
.logout:hover{
	background:url('assets/logout_on.png') no-repeat;
}
-->
</style>

</head>

<body>
	<div id=content>
	<div id=overlay></div>
		<script type="text/javascript" >
	
		$(document).ready(function(){
		   $("#overlay").fadeOut('slow');
		});
	
		$(function (tlogin) {
			$(".tsubmit").click(function () {
				var user = $("#tuser").val();
				var pass = $("#tpass").val();
				var service = $("#tservice").val();
				var dataString = 'tuser=' + user + '&tpass=' + pass;
		
					if (user == '' && pass == '') {
						alert('Must enter all login information.');
					}else{
						$("#twlogin").hide();
						$("#loading").show();
						$("#loading").fadeIn(400).html('Signing In...');
						$.ajax({
							type: "POST",
							url: "bb_login.php",
							data: dataString,
							cache: false,
							success: function (html) {
								$(".tcount").prepend(html);
								$(".tcount").fadeIn("slow");
								$("#loading").hide();
							},
							error: function (html) {
								$("#loading").hide();
								$("#loading").show();
								$("#loading").fadeIn(400).html('Sorry, Error.');
							}
						});
					}return false;
			});
		});
		$(function (flogin) {
			$(".fsubmit").click(function () {
				var user = $("#fuser").val();
				var pass = $("#fpass").val();
				var service = $("#fservice").val();
				var dataString = 'fuser=' + user + '&fpass=' + pass;
		
					if (user == '' && pass == '') {
						alert('Must enter all login information.');
					}else{
						$("#flogin").hide();
						$("#floading").show();
						$("#floading").fadeIn(400).html('Signing In...');
						$.ajax({
							type: "POST",
							url: "bb_login.php",
							data: dataString,
							cache: false,
							success: function (html) {
								$(".fcount").prepend(html);
								$(".fcount").fadeIn("slow");
								$("#floading").hide();
							},
							error: function (html) {
								$("#floading").hide();
								$("#floading").show();
								$("#floading").fadeIn(400).html('Sorry, Error.');
							}
						});
					}return false;
			});
		});
		$(function (llogin) {
			$(".lsubmit").click(function () {
				var user = $("#luser").val();
				var pass = $("#lpass").val();
				var service = $("#lservice").val();
				var dataString = 'luser=' + user + '&lpass=' + pass;
		
					if (user == '' && pass == '') {
						alert('Must enter all login information.');
					}else{
						$("#llogin").hide();
						$("#lloading").show();
						$("#lloading").fadeIn(400).html('Signing In...');
						$.ajax({
							type: "POST",
							url: "bb_login.php",
							data: dataString,
							cache: false,
							success: function (html) {
								$(".lcount").prepend(html);
								$(".lcount").fadeIn("slow");
								$("#lloading").hide();
							},
							error: function (html) {
								$("#lloading").hide();
								$("#lloading").show();
								$("#lloading").fadeIn(400).html('Sorry, Error.');
							}
						});
					}return false;
			});
		});
		</script>
		<div class=entryli>
			<? echo $lloginform; ?>
			<div class=lcount><? echo $linkedin; ?></div>
		</div>
		<div class=entryfb>
			<? echo $floginform; ?>
			<div class=fcount><? echo $facebook; ?></div>
		</div>
		<div class=entrytw>
			<? echo $tloginform; ?>
			<div class=tcount><? echo $twitter; ?></div>
		</div>
		<div class=graphbox>
			<img src=assets/graph_headbb.jpg><br>
	
			<? echo "<img src=\"$graphimg\">"; ?><br><br>
	
		</div>
	</div>
	<div id=footermenu>
		<a href=bb.php class=connections></a>
		<a href=bb_blog.php class=blog></a>
		<a href=bb_tips.php class=tips></a>
		<a href=bb_audibles.php class=audible></a>
		<a href=bb_logout.php class=logout></a>	
	</div>
</body>
</html>
