<?php
/**@var array $movies */
/** @fn formatDurationForHoursAndMinutes */
/**@file */
?>

<div class="movie-list">
	<?php
	foreach ($movies as $movie): ?>
		<div class="movie-list--item">
			<div class="movie-list--item-overlay">
				<a class="movie-list--item-more" href=<?= "movieDetail.php?id=${movie[mID]}" ?>>Подробнее</a>
			</div>
			<div class="movie-list--item-image"
				 style="background-image: url(<?= "../assets/img/${movie[mID]}.jpg" ?>)">
			</div>
			<div class="movie-list--item-head">
				<div class="movie-list--item-title">
					<?= $movie[mTitle] ?>
				</div>
				<div class="movie-list--item-subtitle">
					<?= $movie[mOriginTitle] ?>
				</div>
			</div>
			<div class="movie-list--item-description">
				<?= $movie[mDescription] ?>
			</div>
			<div class="movie-list--item-bottom">
				<div class="movie-list--item-bottom-icon"
					 style="background-image: url(<?= "../icons/clock1.svg" ?>)">

				</div>
				<div class="movie-list--item-time">
					<?= formatDurationForHoursAndMinutes($movie[mDuration]) ?>
				</div>
				<div class="movie-list--item-info">
					<?= implode(',', $movie[mGenres]) ?>
				</div>
			</div>
		</div>
	<?php
	endforeach; ?>
</div>