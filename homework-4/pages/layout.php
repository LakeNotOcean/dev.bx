<?php
/** @var string $menuList */
/** @var string $header */
/** @var string $content */
?>

<!doctype html>
<html lang="eu">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="./homework-4/css/reset.css">
	<link rel="stylesheet" href="./homework-4/css/index.css">
</head>
<body>
<div class="wrapper">
	<div class="sidebar">
		<div class="sidebar-logo">BITFLIX</div>
		<?= $menuList ?>
	</div>
	<div class="container">
		<?= $header ?>
		<div class="content">
			<?= $content ?>
		</div>
	</div>
</div>
</div>
</body>
</html>
