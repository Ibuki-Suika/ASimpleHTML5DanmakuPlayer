<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
	<head>
		<script type="text/javascript" src="loadxmldoc.js"></script>
		<script type="text/javascript" src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
		<style>
		input{
			transition:all 0.30s ease-in-out;
			-webkit-transition: all 0.30s ease-in-out;
			-moz-transition: all 0.30s ease-in-out;
			
			border:#35a5e5 1px solid;
			border-radius:3px;
			outline:none;
		}
		input:focus{
			box-shadow:0 0 5px rgba(81, 203, 238, 1);
			-webkit-box-shadow:0 0 5px rgba(81, 203, 238, 1);
			-moz-box-shadow:0 0 5px rgba(81, 203, 238, 1);
		}
		a{
			text-decoration:none;
			background:rgba(81, 203, 238, 1);
			color:white;padding: 6px 25px 6px 25px;
			font:12px '微软雅黑';
			border-radius:3px;
			
			-webkit-transition:all linear 0.30s;
			-moz-transition:all linear 0.30s;
			transition:all linear 0.30s;
		}
		a:hover{background:rgba(39, 154, 187, 1);}
		</style>
	</head>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<body>
		<video hidden=true id="Video" controls width="672" autoplay src="demo.mp4"></video>
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
			<div align=center>
				<input type="text" id="text_danmaku" style="width:570px;height:30px"></input>
				<button class="btn btn-small btn-orange" type="submit" id="btn_senddm" onclick="btn_senddm_click()" style="width:102px;height:30px">发送弹幕</button>
			</div>
		</div>
    </body>
	<script>
		function SendADanmaku(Text)
		{
			lastdanmaku = lastdanmaku + 1;
			danmaku_location_x[lastdanmaku] = c.width;
			danmaku_location_y[lastdanmaku] = parseInt(fontsize);
			danmaku_text[lastdanmaku] = Text;
			danmaku_length[lastdanmaku] = jmz.GetLength(Text) * parseInt(fontsize)
			if (danmaku_location_x[lastdanmaku - 1]>c.width - danmaku_length[lastdanmaku-1])
			{
				danmaku_location_y[lastdanmaku] = danmaku_location_y[lastdanmaku-1] + parseInt(fontsize)
			}
		}
		function btn_senddm_click()
		{
			SendADanmaku(text_danmaku.value);
			AddADanmaku(text_danmaku.value);
			text_danmaku.value = "";
		}
	</script>
    <script type="text/javascript">
        var v = document.getElementById("Video");
        var c = document.getElementById("DanmakuPlayer");
        ctx = c.getContext('2d');
		v.volume = 0.1;
		var danmaku_location_x = new Array();
		var danmaku_location_y = new Array();
		var danmaku_text = new Array();
		var danmaku_length = new Array();
		var lastdanmaku = 0;
		var fontsize = "20";
		var tunit = 1;
		var _debug
		xmlDoc = loadXMLDoc("./danmaku.xml");
		var oSerializer = new XMLSerializer();
		var sXML = oSerializer.serializeToString(xmlDoc);
		ctx.font = fontsize + "px 黑体";
		ctx.fillStyle = "white";
		ctx.strokeStyle = "black";
		ctx.lineWidth = 1;
		function AddADanmaku(Text)
		{
			$.ajax({
				type: "get",
				url: "dm.php?dm="+Text+"&t="+tunit,
			});
		}
        v.addEventListener('play', function() {
        var i = window.setInterval(function() {
            ctx.drawImage(v, 0, 0, 672, 380)
			tunit = tunit + 1
			if (sXML.indexOf("d"+tunit) > 0)
			{
				SendADanmaku(xmlDoc.getElementsByTagName("d"+tunit)[0].childNodes[0].nodeValue);
			}
			for (var i=lastdanmaku;i>-1;i--)
					{
					if (danmaku_location_x[i]>-c.width)
						{
						danmaku_location_x[i] = danmaku_location_x[i] - 2
						ctx.fillText(danmaku_text[i],danmaku_location_x[i],danmaku_location_y[i])
						ctx.strokeText(danmaku_text[i],danmaku_location_x[i],danmaku_location_y[i])
						}
					}
			}, 20)
		}, false);
    </script>
	<script>
	var jmz = {};
	jmz.GetLength = function(str) {
		return str.replace(/[\u0391-\uFFE5]/g,"aa").length;
	};
	</script>
</html>