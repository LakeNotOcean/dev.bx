<?php
/**@var array $genreItems */
/**@var string $currentActiveItem */
/**@var    array $menuConstItems */
/** @var string $pagesPath */
/** @var string $baseURL */
?>

<ul class="menu">

	<li class="menu-item <?= $currentActiveItem === 'main' ? "menu-item--active" : "" ?>">
		<a href=<?= "${baseURL}index.php" ?>><?= $menuConstItems["main"] ?></a>
	<li class="menu-item <?= $currentActiveItem === 'favorites' ? "menu-item--active" : "" ?>">
		<a href=<?= "${baseURL}${pagesPath}/favorites.php" ?>><?= $menuConstItems["favourites"] ?></a>
		<?
		foreach ($genreItems

		as $key => $value): ?>
	<li class="menu-item <?= $currentActiveItem === $key ? "menu-item--active" : "" ?>">
		<a href=<?= "${baseURL}index.php?genre=${key}" ?>><?= $value ?></a>
		<?php
		endforeach; ?>
</ul>