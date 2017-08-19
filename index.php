<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
	<head>
		<script type="text/javascript" src="loadxmldoc.js"></script>
		<script type="text/javascript" src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
		<style>
		input[type='text']{
			transition:all 0.30s ease-in-out;
			-webkit-transition: all 0.30s ease-in-out;
			-moz-transition: all 0.30s ease-in-out;
			
			border:#35a5e5 1px solid;
			border-radius:3px;
			outline:none;
			font:12px '微软雅黑';
		}
		input[type='text']:focus{
			box-shadow:0 0 5px rgba(81, 203, 238, 1);
			-webkit-box-shadow:0 0 5px rgba(81, 203, 238, 1);
			-moz-box-shadow:0 0 5px rgba(81, 203, 238, 1);
		}
		body{background-size:100%;}
		textarea{
			transition:all 0.30s ease-in-out;
			-webkit-transition: all 0.30s ease-in-out;
			-moz-transition: all 0.30s ease-in-out;
			
			border:#35a5e5 1px solid;
			border-radius:3px;
			outline:none;
			font:12px '微软雅黑';
		}
		textarea:focus{
			box-shadow:0 0 5px rgba(81, 203, 238, 1);
			-webkit-box-shadow:0 0 5px rgba(81, 203, 238, 1);
			-moz-box-shadow:0 0 5px rgba(81, 203, 238, 1);
		}
		</style>
	<script>
		window.onerror=function(){return true;} 
	</script>
	</head>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<body>
		<br>
		<br>
		<video hidden=true id="Video" width="672" src=""></video>
		<div id="maincontent">
			<div class="container" id="dmplayer">
				<canvas id="DanmakuPlayer" width="672" height="380"></canvas>
			</div>
			<style type="text/css">
				.container{
					margin:0 auto;
					width:672px;
				}
			</style>
			<input id="VideoSlider" type="range" style="width:672px; height:15px; margin:0 auto;display:block;" min="0" max="100" value="0" onclick="VideoSliderFunction()"/>  
			<div align=center>
				<input type="text" id="text_danmaku" style="width:382px;height:30px;" placeholder="这儿可以发弹幕(*。∀。)"></input>
				<button class="btn btn-small btn-orange" type="submit" id="btn_senddm" onclick="btn_senddm_click()" style="width:92px;height:30px">发送弹幕</button>
				<input id="VolumeSlider" type="range" style="width:100px; height:15px;" min="0" max="100" value="100" onclick="VolumeSliderFunction()"/>  
				<button class="btn btn-small btn-orange" id="btn_play" style="width:64px;height:30px" onclick="btn_play_click()">►/‖</button>
			</div>
			<br>
			<div>
				<textarea readonly="readonly" id="desc_textarea" style="margin:0 auto;display:block;width:672px;height:92px;resize:none;color:grey;"></textarea>
			</div>
		</div>
		<footer>
		<br>
		<p align=center>Izumi's Danmaku Player  -  一个开源弹幕播放器 <a href="#">开放许可</a></p>
		<br>
		</footer>
    </body>
	<script>
		window.onload = function() {
			if(window.applicationCache){
				var html5=true;
			}
			else{
				var html5=false;
				alert("你所使用的浏览器不支持HTML5，推荐使用Chrome浏览本页。");
			}
		}
		var ms;
		function VolumeSliderFunction()
		{
			v.volume = VolumeSlider.value / 100;
		}
		function VideoSliderFunction()
		{
			v.currentTime = VideoSlider.value;
			ms = VideoSlider.value * 1000;
			tunit = ms/20;
		}
		function SendADanmaku(Text)
		{
			lastdanmaku = lastdanmaku + 1;
			danmaku_location_x[lastdanmaku] = c.width;
			danmaku_location_y[lastdanmaku] = parseInt(fontsize);
			danmaku_text[lastdanmaku] = Text;
			danmaku_length[lastdanmaku] = jmz.GetLength(Text) * parseInt(fontsize) * 0.5
			if (danmaku_location_x[lastdanmaku - 1]>c.width - danmaku_length[lastdanmaku-1])
			{
				danmaku_location_y[lastdanmaku] = danmaku_location_y[lastdanmaku-1] + parseInt(fontsize)
				if(danmaku_location_y[lastdanmaku] > 380)
				{
					danmaku_location_y[lastdanmaku]=0;
				}
			}
		}
		function btn_senddm_click()
		{
			SendADanmaku(text_danmaku.value);
			AddADanmaku(text_danmaku.value);
			text_danmaku.value = "";
		}
		function btn_play_click()
		{
			if(isplaying == 1)
			{
				isplaying = 0;
				Video.pause();
			}
			else
			{
				isplaying = 1;
				Video.play();
			}
		}
	</script>
    <script type="text/javascript">
			<?php
		$vidno = @$_GET['v'];
		$myfile = fopen("data/" . $vidno . "/info.xml", "r");
		$xmlstr = fread($myfile,filesize("data/" . $vidno . "/info.xml"));
		$xml = new SimpleXMLElement($xmlstr);
		$returndata = $xml->root->title;
		?> 
		var vid_title = "<?php echo $returndata?>"
		var vid_desc = "<?php 
		$returndata = $xml->root->desc;
		echo $returndata?>"
		var vid_author = "<?php 
		$returndata = $xml->root->author;
		echo $returndata?>"
		var v = document.getElementById("Video");
        var c = document.getElementById("DanmakuPlayer");
		var videonumber = "<?php echo @$_GET['v']?>";
		var vid_source ="<?php 
		$returndata = $xml->root->source;
		echo $returndata?>"
		var vid_bg = "<?php 
		$returndata = $xml->root->bg;
		echo $returndata?>"
		var vid_avatar = "<?php 
		$returndata = $xml->root->avatar;
		echo $returndata?>"
		document.getElementById('desc_textarea').value=vid_desc;
		var pagetitle = "Izumi's"
		document.title = "【" + pagetitle + "】 " + vid_title + " - " + vid_author;
		var vidroot = "data/"+videonumber+"/"
        ctx = c.getContext('2d');
		v.volume = 0.1;
		var danmaku_location_x = new Array();
		var danmaku_location_y = new Array();
		var danmaku_text = new Array();
		var danmaku_length = new Array();
		var lastdanmaku = 0;
		var fontsize = "20";
		var tunit = 1;
		var _debug;
		var xhr = new XMLHttpRequest();
		xhr.open("GET","./"+vidroot+"danmaku.xml",false);
		xhr.send(null);
		doc = xhr.responseXML;
		sXML = xhr.responseText;
		var isplaying = 0;
		ctx.font = fontsize + "px 黑体";
		ctx.fillStyle = "white";
		ctx.strokeStyle = "black";
		ctx.lineWidth = 1;
		var speed = 2;
		var danmaku_content;
		v.onwaiting = function () {
			isplaying = 0;
			v.pause();
		};
		$('#Video').attr('src', vid_source);
		v.pause();
		document.body.style.backgroundImage="url("+vid_bg+")";
		function AddADanmaku(Text)
		{
			$.ajax({
				type: "get",
				url: "dm.php?dm="+Text+"&t="+tunit+"&v="+videonumber,
			});
		}
        document.getElementById("Video").addEventListener("play", function(){
			VideoSlider.max = v.duration;
		});
		var Interval = window.setInterval(function() {
		if (isplaying == 1)
			{
				ctx.drawImage(v, 0, 0, 672, 380);
				tunit = tunit + 1;
				VideoSlider.value = v.currentTime;
				if (sXML.indexOf("d"+tunit) > 0)
				{
					danmaku_content=doc.getElementsByTagName("d"+tunit)[0].childNodes[0].nodeValue;
					SendADanmaku(String(danmaku_content));
				}
				for (var i=lastdanmaku;i>-1;i--)
						{
						if (danmaku_location_x[i]>-c.width)
							{
							danmaku_location_x[i] = danmaku_location_x[i] - speed
							ctx.fillText(danmaku_text[i],danmaku_location_x[i],danmaku_location_y[i])
							ctx.strokeText(danmaku_text[i],danmaku_location_x[i],danmaku_location_y[i])
							}
						}
				}
			}, 20)
    </script>
	<script>
	var jmz = {};
	jmz.GetLength = function(str) {
		return str.replace(/[\u0391-\uFFE5]/g,"aa").length;
	};
	</script>
</html>
