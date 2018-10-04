<? var_dump($data); ?>

<section class="s-nav">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<a href="#">Reviews</a>
			</div>
		</div>
	</div>
</section>
<section class="s-reviews">
	<div class="container-fluid">
		<div class="row">
			<div class="item">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						<div class="review-image">
							<img class="responsive-img" src="/images/reviews/1.jpg" alt="Review">
						</div>
					</div>
			</div>
			<div class="item">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						<div class="review-image">
							<img class="responsive-img" src="/images/reviews/1.jpg" alt="Review">
						</div>
					</div>
			</div>
			<div class="item">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						<div class="review-image">
							<img class="responsive-img" src="/images/reviews/1.jpg" alt="Review">
						</div>
					</div>
			</div>
			<div class="item">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						<div class="review-image">
							<img class="responsive-img" src="/images/reviews/1.jpg" alt="Review">
						</div>
					</div>
			</div>
			<div class="item">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						<div class="review-image">
							<img class="responsive-img" src="/images/reviews/1.jpg" alt="Review">
						</div>
					</div>
			</div>
			<div class="item">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						<div class="review-image">
							<img class="responsive-img" src="/images/reviews/1.jpg" alt="Review">
						</div>
					</div>
			</div>
			<div class="item">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						<div class="review-image">
							<img class="responsive-img" src="/images/reviews/1.jpg" alt="Review">
						</div>
					</div>
			</div>
			<div class="item">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						<div class="review-image">
							<img class="responsive-img" src="/images/reviews/1.jpg" alt="Review">
						</div>
					</div>
			</div>
		</div>
	</div>
</section>
				
<!-- <section class="s-nav">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<div class="navigation">
				<?
					$hrefPrev = "";
					if ( in_array($data["HrefPath"][count($data["HrefPath"]) - 1], LanguageSelect::$SubCategoryArray) === true )
						$hrefPrev .= $data["HrefPath"][count($data["HrefPath"]) - 1];
					if ($data["PageNumber"] > 1) {
						$hrefPrev .= "/" . ($data["PageNumber"] - 1);
						echo "<a href=\"" . $hrefPrev . "\" class=\"previos\">Previos</a>";
					}
				?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="navigation">
				<?
					$hrefNext = "";
					if ( in_array($data["HrefPath"][count($data["HrefPath"]) - 1], LanguageSelect::$SubCategoryArray) === true )
						$hrefNext .= $data["HrefPath"][count($data["HrefPath"]) - 1];
					if ($data["PageNumber"] < $data["MaxPages"]) {
						$hrefNext .= "/" . ($data["PageNumber"] + 1);
						echo "<a href=\"" . $hrefNext . "\" class=\"Next\">Next</a>";
					}
				?>
				</div>
			</div>
		</div>
	</div>
</section> -->