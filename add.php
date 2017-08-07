<html>
<?php
	$n = @$_GET['n'];
	mkdir("data/" . $n);
	copy("data/0/danmaku.xml","data/" . $n . "/danmaku.xml");
	copy("data/0/info.xml","data/" . $n . "/info.xml");
?>
</html>