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
 -->
</style>
<div class=header></div>
<?



			$rawxml = file_get_contents("http://redzonemarketing.com/blog/wp-content/plugins/wp_mail_chimp_xml.php?list");
			$xml = simplexml_load_string($rawxml);
			$xml = $xml->wpmc;
			foreach($xml->item AS $key){
				$title = $key->{"title"};
				$date = $key->{"date"};
				$contentid = $key->{"contentid"};
				echo "<a href=\"http://redzonemarketing.com/blog/wp-content/plugins/wp_mail_chimp_xml.php?cid=$contentid\">$title</a>";
			}

?>

	<div id=footermenu>
		<a href=bb.php class=connections></a>
		<a href=bb_blog.php class=blog></a>
		<a href=bb_tips.php class=tips></a>
		<a href=bb_audibles.php class=audible></a>
		<a href=bb_logout.php class=logout></a>	
	</div>