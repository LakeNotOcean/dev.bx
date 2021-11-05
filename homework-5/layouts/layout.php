<?php
/** @var string $menuLayout */
/** @var string $headerLayout */
/** @var string $content */
/** @var string $sidebarLogoPath */
/** @var string $homeworkPath */
/** @var string $baseURL */

?>

<!doctype html>
<html lang="eu">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Bitflix</title>
	<link rel="stylesheet" href=<?= "${baseURL}${homeworkPath}/css/reset.css" ?>>
	<link rel="stylesheet" href=<?= "${baseURL}${homeworkPath}/css/index.css" ?>>
</head>
<body>
<div class="wrapper">
	<div class="sidebar">
		<img class="sidebar-logo" alt="BITFLIX" src=<?= "${baseURL}${sidebarLogoPath}" ?>>
		<?= $menuLayout ?>
	</div>
	<div class="container">
		<?= $headerLayout ?>
		<div class="content">
			<?= $content ?>
		</div>
	</div>
</div>
</body>
</html>
