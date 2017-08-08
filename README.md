# A Simple HTML5 DanmakuPlayer
This is the most easiest sample of making an danmaku player
这是一个最简单的弹幕播放器例子，通过HTML+JS+PHP实现，弹幕发送后会后台会自动覆写xml。写这个脚本的人，我--就是个傻子，连Node.js都不会用2333333333333333.没办法，用PHP凑合凑合吧。

# 播放器原理
利用HTML5的Canvas每20ms绘出视频帧，然后再用filltext来满足弹幕效果。

# 弹幕保存/加载 原理
弹幕通过默认的danmaku.xml（可以更改为其他名称）来加载弹幕，同时每发送一条弹幕会自动写入sXML，后期如有需要可以通过php来实现弹幕文件保存。

# index.php 的打开方式
例：index.php?v=1
其中v是视频号，与所要打开data目录下的读取的文件目录一致。

# danmaku.xml 的用法详解
例：<playerdata><danmaku><d110>TEST</d110></danmaku></playerdata>
其中除<d110>TEST</d110>以外均是必须有的元素，<d110>TEST</d110>表示的是：第110个单位时间发送弹幕文字为TEST（每20ms为一个单位时间）。

# info.xml 的用法详解
里面内容可以根据 index.php 里调用的用法自行调节。

# dm.php 的传递参数
例：dm.php?dm="这是一条弹幕"&t=233
其中dm参数是弹幕消息，t参数是单位时间。前端利用ajax请求来传递参数。

# add.php 的用法
例：add.php?n=1
其中n是视频号，规定该视频内容存放在data文件夹下的某一目录中。

loadxmldoc.js 是解析xml用的js脚本。
data下的0目录切记不能删除，是用于后续添加的视频信息作为被复制的对象。所有需要的xml都从0目录中复制。
