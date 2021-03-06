<?php
/**@var array $genreItems */
/**@var string $currentActiveItem */
/**@var    array $menuConstItems */

?>

<ul class="menu">

	<li class="menu-item <?= $currentActiveItem === 'main' ? "menu-item--active" : "" ?>">
		<a href=<?= "index.php" ?>><?= $menuConstItems["main"] ?></a>
	</li>
	<li class="menu-item <?= $currentActiveItem === 'favorites' ? "menu-item--active" : "" ?>">
		<a href=<?= "favorites.php" ?>><?= $menuConstItems["favourites"] ?></a>
	</li>
		<?php foreach ($genreItems as $key => $value): ?>
	<li class="menu-item <?= $currentActiveItem === $key ? "menu-item--active" : "" ?>">
		<a href=<?= "index.php?genre=${key}" ?>><?= $value ?></a>
		<?php
		endforeach; ?>
	</li>
</ul>