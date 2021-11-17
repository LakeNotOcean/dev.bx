<?php
/** @var array $movie */
/** @var int $numbOfActiveRatingSquare */
?>
<div class="movie-detail">
	<div class="movie-detail-head">

		<div class="movie-detail-title">
			<p><?= $movie[mTitle] ?></p>
			<div class="movie-detail-title-subtitle">
				<p><?= $movie[mOriginTitle] ?></p>
				<div class="movie-detail-title-age">
					<?= $movie[mAge] . '+' ?>
				</div>
			</div>
		</div>
		<div class="movie-detail-title-fav-icon">
			<img class="movie-detail-title-fav" src="<?= "../assets/icons/favIcons/notFav.svg" ?>" alt="Избранное"/>
			<img class="movie-detail-title-fav-hover" src="<?= "../assets/icons/favIcons/fav.svg" ?>" alt="Избранное"/>
		</div>
	</div>
	<div class="movie-detail-description">
		<img class="movie-detail-description-image" src="<?= "../assets/img/${movie[mID]}.jpg" ?>" alt="Постер"/>
		<div class="movie-detail-description-info">
			<div class="movie-detail-description-info-rating">
				<?php for ($i = 0; $i < 10; $i++): ?>
					<div class="movie-detail-description-info-rating-square <?= $i < $numbOfActiveRatingSquare ? "active" : "" ?>"></div>
				<?php endfor; ?>
				<div class="movie-detail-description-info-rating-grade">
					<?= $movie[mRating] ?>
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
					<p><?= $movie[mRelease] ?></p>
					<p><?= $movie[dName] ?></p>
					<p><?= implode(',', $movie[aNames]) ?></p>
				</div>
			</div>
			<h1>Описание</h1>
			<div class="movie-detail-description-info-full">
				<?= $movie[mDescription] ?>
			</div>
		</div>
	</div>
</div>

