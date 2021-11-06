<?php
/**@var array $movies */
/** @fn formatDurationForHoursAndMinutes */
?>

<div class="movie-list">
	<?php
	foreach ($movies as $movie): ?>
		<div class="movie-list--item">
			<div class="movie-list--item-overlay">
				<a class="movie-list--item-more" href=<?= "movieDetail.php?id=${movie['id']}" ?>>Подробнее</a>
			</div>
			<div class="movie-list--item-image"
				 style="background-image: url(<?= "../assets/img/${movie['id']}.jpg" ?>)">
			</div>
			<div class="movie-list--item-head">
				<div class="movie-list--item-title">
					<?= $movie['title'] ?>
				</div>
				<div class="movie-list--item-subtitle">
					<?= $movie['original-title'] ?>
				</div>
			</div>
			<div class="movie-list--item-description">
				<?= $movie['description'] ?>
			</div>
			<div class="movie-list--item-bottom">
				<div class="movie-list--item-bottom-icon"
					 style="background-image: url(<?= "../icons/clock1.svg" ?>)">

				</div>
				<div class="movie-list--item-time">
					<?= formatDurationForHoursAndMinutes($movie['duration']) ?>
				</div>
				<div class="movie-list--item-info">
					<?= implode(',', $movie['genres']) ?>
				</div>
			</div>
		</div>
	<?php
	endforeach; ?>
</div>