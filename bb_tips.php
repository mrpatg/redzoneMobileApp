<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
</head>

<style>
<!-- 
body{
	width:320px;
	margin:0px;
}
.header{
	display:block;
	width:320px;
	height:44px;
	background:url('assets/bb_audilbes_topbg.png');
}
a{
	display:block;
	height:55px;
	width:320px;
	float:left;
	background:url('assets/bb_audilbes_menubg.png');
	color:#000;
	text-decoration:none;
	font-family:verdana;
	line-height:55px;
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
.tipbubble{
clear:both;
	width:280px;
	height:303px;
	display:none;
position:absolute;
top:30px;
	margin-top:30px;
	background:url('assets/bubble.png');
	margin-left:auto;
	margin-right:auto;
text-align:center;

}
.tiptext{

margin-top:25px;
	display:inline-block;
	width:260px;
height:303px;
	margin-left:auto;
	margin-right:auto;
	font-family:verdana;
	font-size:12px;
	font-weight:bold;
	color:#fff;
}
 -->
</style>
<body>
<div class=header></div>

<?



			$rawxml = file_get_contents("http://redzonemarketing.com/blog/wp-content/plugins/wp_tips_xml.php");
			$rawxml = str_replace("â€™", "'", $rawxml);
			$rawxml = str_replace("â", "'", $rawxml);
			$rawxml = str_replace("'€”", " ", $rawxml);
			$xml = simplexml_load_string($rawxml);
			$xml = $xml->tips;
			$i = 0;
			foreach($xml->tip AS $key){
				$i++;
				$title = $key->{"title"};
				$tiptext = $key->{"tiptext"};

				echo "<a href=\"#\" onClick=\"if($(this).next('div').css('display') == 'none') { $(this).next('div').show(); } else { $(this).next('div').hide(); } return false;\">$title</a><div class=tipbubble onClick=\"$(this).hide(); return false;\"></span><span class=tiptext>$tiptext</span></div><br><br>";
			}

?>

	<div id=footermenu>
		<a href=bb.php class=connections></a>
		<a href=bb_blog.php class=blog></a>
		<a href=bb_tips.php class=tips></a>
		<a href=bb_audibles.php class=audible></a>
		<a href=bb_logout.php class=logout></a>	
	</div>

</body>
</html>