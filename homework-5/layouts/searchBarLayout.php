<?php
/**@var string $searchIconPath */
/** @var string $baseURL */
/** @var string $homeworkPath */
?>

<div class="header">
	<div class="header-panel">
		<form method="get" class="searchbar" action=<?= "${baseURL}index.php" ?> >
			<div class="search-icon" style="background-image:url(<?= "${baseURL}$searchIconPath" ?>)"></div>
			<label>
				<input class="search-space" type="text" name="search" placeholder="Поиск по каталогу...">
			</label>
			<input class="header-button search-button" type="submit" value="искать">
		</form>
		<a class="header-button add-button" href=<?= "${baseURL}${homeworkPath}/pages/addMovie.php" ?>>добавить фильм
		</a>
	</div>
</div>