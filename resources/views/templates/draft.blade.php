<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MEA CMS PREVIEW</title>
</head>
<body style="margin:auto; text-align:center; height:auto;">
<iframe src="{{{URL::asset('temp/'. $id.'.html')}}}" height="100%" width="800" style="border:1px solid #CCC;" onload="this.style.height = parseInt(80)+this.contentWindow.document.body.scrollHeight + 'px';"></iframe>
</body>
</html>