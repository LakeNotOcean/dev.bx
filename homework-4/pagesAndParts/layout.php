<?php
/** @var string $menuListLayout */
/** @var string $headerLayout */
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
		<img class="sidebar-logo" src="./homework-4/assets/icons/Bitflix.svg" alt="BITFLIX">
		<?= $menuListLayout ?>
	</div>
	<div class="container">
		<?= $headerLayout ?>
		<div class="content">
			<?= $content ?>
		</div>
	</div>
</div>
</div>
</body>
</html>
