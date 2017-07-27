# A Simple HTML5 DanmakuPlayer
This is the most easiest sample of making an danmaku player
这是一个最简单的弹幕播放器例子，仅通过HTML+JS实现，代码清晰明了。

# 播放器原理
利用HTML5的Canvas每20ms绘出视频帧，然后再用filltext来满足弹幕效果。

# 弹幕保存/加载 原理
弹幕通过默认的danmaku.xml（可以更改为其他名称）来加载弹幕，同时每发送一条弹幕会自动写入sXML，后期如有需要可以通过php来实现弹幕文件保存。

# danmaku.xml 的用法详解
例：<playerdata><danmaku><d110>TEST</d110></danmaku></playerdata>
其中除<d110>TEST</d110>以外均是必须有的元素，<d110>TEST</d110>表示的是：第110个单位时间发送弹幕文字为TEST（每20ms为一个单位时间）。

loadxmldoc.js 是解析xml用的js脚本。
