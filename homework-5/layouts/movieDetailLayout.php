<?php
/** @var array $movie */
/** @var string $favIconsPath */
/** @var string $moviesImagePath */
/** @var int $numbOfActiveRatingSquare */
/** @var string $baseURL */
?>
<div class="movie-detail">
	<div class="movie-detail-head">

		<div class="movie-detail-title">
			<p><?= $movie['title'] ?></p>
			<div class="movie-detail-title-subtitle">
				<p><?= $movie['original'] ?></p>
				<div class="movie-detail-title-age">
					<?= $movie['age-restriction'] . '+' ?>
				</div>
			</div>
		</div>
		<div class="movie-detail-title-fav-icon">
			<img class="movie-detail-title-fav" src="<?= "${baseURL}${favIconsPath}notFav.svg" ?>" alt="Избранное"/>
			<img class="movie-detail-title-fav-hover" src="<?= "${baseURL}${favIconsPath}fav.svg" ?>" alt="Избранное"/>
		</div>
	</div>
	<div class="movie-detail-description">
		<img class="movie-detail-description-image" src="<?= "${baseURL}${moviesImagePath}/${movie['id']}.jpg" ?>" alt="Постер"/>
		<div class="movie-detail-description-info">
			<div class="movie-detail-description-info-rating">
				<?
				for ($i = 0; $i < $numbOfActiveRatingSquare && $i < 10; $i++): ?>
					<div class="movie-detail-description-info-rating-square active"></div>
				<?
				endfor; ?>
				<?
				for ($i = $numbOfActiveRatingSquare; $i < 10; $i++): ?>
					<div class="movie-detail-description-info-rating-square"></div>
				<?
				endfor; ?>
				<div class="movie-detail-description-info-rating-grade">
					<?= $movie['rating'] ?>
				</div>
			</div>
			<h1>О Фильме</h1>
			<div class="movie-detail-description-info-feature">
				<div class="movie-detail-description-info-feature-cat">
					<p>Год производства:</p>
					<p>Режиссер:</p>
					<p>В главных ролях: </p>
				</div>
				<div class="movie-detail-description-info-feature-data">
					<p><?= $movie['release-date'] ?></p>
					<p><?= $movie['director'] ?></p>
					<p><?= implode(',', $movie['cast']) ?></p>
				</div>
			</div>
			<h1>Описание</h1>
			<div class="movie-detail-description-info-full">
				<?= $movie['description'] ?>
			</div>
		</div>
	</div>
</div>

