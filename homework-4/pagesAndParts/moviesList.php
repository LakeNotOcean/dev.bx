<?php
/**@var array $movies */
?>

<div class="movie-list">
	<?php
	foreach ($movies as $movie): ?>
		<div class="movie-list--item">
			<div class="movie-list--item-overlay">
				<a href="" class="movie-list--item-more">Подробнее</a>
			</div>
			<div class="movie-list--item-image"
				 style="background-image: url('<?= $movie['imagePath'] ?>')">
			</div>
			<div class="movie-list--item-head">
				<div class="movie-list--item-title">
					<?= $movie['name'] ?>
				</div>
				<div class="movie-list--item-subtitle">
					<?= $movie['engName'] ?>
				</div>
			</div>
			<div class="movie-list--item-description">
				<?= $movie['description'] ?>
			</div>
			<div class="movie-list--item-bottom">
				<div class="movie-list--item-bottom-icon"
					 style="background-image: url('./homework-4/assets/icons/clock 1.svg')">

				</div>
				<div class="movie-list--item-time">
					<?= $movie['time'] ?>
				</div>
				<div class="movie-list--item-info">
					<?= $movie['genres'] ?>
				</div>
			</div>
		</div>
	<?php
	endforeach; ?>
</div>