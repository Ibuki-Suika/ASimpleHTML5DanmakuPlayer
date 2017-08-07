<html>
	<head>
	<script type="text/javascript" src="loadxmldoc.js"></script>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' /> 
	</head>
	<?php
		$danmakutext = @$_GET['dm'];
		$danmakutime = @$_GET['t'];
		$vidno = @$_GET['v'];
		$myfile = fopen("data/" . $vidno . "/danmaku.xml", "r");
		$xmlstr = fread($myfile,filesize("data/" . $vidno . "/danmaku.xml"));
		fclose($myfile);
		$myfile = fopen("data/" . $vidno . "/danmaku.xml", "w");
		$xml = new SimpleXMLElement($xmlstr);
		$danmaku = $xml->danmaku;
		$danmaku->addChild('d' . $danmakutime, $danmakutext);
		$savexml = $xml->asXML();
		fwrite($myfile,$savexml);
		fclose($myfile);
	?> 
</html>