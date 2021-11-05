<?php
/**@var array $movies */
/**@var string $moviesImagePath */
/**@var string $clockImagePath */
/** @var string $pagesPath */
/** @fn formatDurationForHoursAndMinutes */
/** @var string $baseURL */
?>

<div class="movie-list">
	<?
	foreach ($movies as $movie): ?>
		<div class="movie-list--item">
			<div class="movie-list--item-overlay">
				<a href=<?= "${pagesPath}/movieDetail.php?id=${movie['id']}" ?> class="movie-list--item-more">Подробнее</a>
			</div>
			<div class="movie-list--item-image"
				 style="background-image: url(<?= "${baseURL}${moviesImagePath}/${movie['id']}.jpg" ?>)">
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
					 style="background-image: url(<?= "${baseURL}${clockImagePath}" ?>)">

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