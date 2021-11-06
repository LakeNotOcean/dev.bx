<?php
/** @var string $menuLayout */
/** @var string $content */

?>

<!doctype html>
<html lang="eu">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Bitflix</title>
	<link rel="stylesheet" href=<?= "../css/reset.css" ?>>
	<link rel="stylesheet" href=<?= "../css/index.css" ?>>
</head>
<body>
<div class="wrapper">
	<div class="sidebar">
		<img class="sidebar-logo" alt="BITFLIX" src=<?= "../assets/icons/Bitflix.svg" ?>>
		<?= $menuLayout ?>
	</div>

	<div class="container">
		<div class="header">
			<div class="header-panel">
				<form method="get" class="searchbar" action=<?= "index.php" ?> >
					<div class="search-icon" style="background-image:url(<?= "../assets/icons/search1.svg" ?>)"></div>
					<label>
						<input class="search-space" type="text" name="search" placeholder="Поиск по каталогу...">
					</label>
					<input class="header-button search-button" type="submit" value="искать">
				</form>
				<a class="header-button add-button" href=<?= "addMovie.php" ?>>добавить фильм
				</a>
			</div>
		</div>
		<div class="content">
			<?= $content ?>
		</div>
	</div>
</div>
</body>
</html>
