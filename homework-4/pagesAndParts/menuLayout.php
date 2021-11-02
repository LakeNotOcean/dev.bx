<?php
	/**@var array $menuItemsRef*/
?>

<ul class="menu">
	<?php
	foreach ($menuItemsRef

	as $key => $value): ?>
	<li class="menu-item">
		<a href=<?= $value ?>><?= $key ?></a>
		<?php
		endforeach; ?>
</ul>