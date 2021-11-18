<?php
/**@var array $genreItems */
/**@var string $currentActiveItem */
/**@var    array $menuConstItems */

?>

<ul class="menu">

	<li class="menu-item <?= $currentActiveItem === menuMain ? "menu-item--active" : "" ?>">
		<a href=<?= "index.php" ?>><?= $menuConstItems[menuMain] ?></a>
	</li>
	<li class="menu-item <?= $currentActiveItem === menuFavourites ? "menu-item--active" : "" ?>">
		<a href=<?= "favorites.php" ?>><?= $menuConstItems[menuFavourites] ?></a>
	</li>
		<?php foreach ($genreItems as $key => $value): ?>
	<li class="menu-item <?= $currentActiveItem === $value[gCODE] ? "menu-item--active" : "" ?>">
		<a href=<?= "index.php?genre=${value[gCODE]}" ?>><?= $value[gName] ?></a>
		<?php
		endforeach; ?>
	</li>
</ul>