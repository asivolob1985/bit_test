<?php

?>
<!DOCTYPE html>
<!--[if IE 8]>
<html lang="ru"><![endif]-->
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title><?=$title?></title>
	<link href="/application/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/application/css/style.css" rel="stylesheet" type="text/css">
	<script src="/application/js/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="/application/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
	<div class="content">
		<h1><?=$title?></h1>
		<div class="row">
			<?php include 'application/views/'.$content_view; ?>
		</div>
	</div>
</div>
</body>
</html>