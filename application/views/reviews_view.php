<section class="s-nav">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?
				echo "<a href='/" . LanguageSelect::$lang . "/reviews'>" . 
					((LanguageSelect::$lang === "RU") ? "Отзывы" : "Reviews") . "</a>";
			?>
			</div>
		</div>
	</div>
</section>
<section class="s-reviews">
	<div class="container-fluid">
		<div class="row">

			<?
				for($i = 0; $i < count($data); $i++) {
					$imageURL = $data[$i]["HrefPic"];
					$InstURL = $data[$i]["HrefInst"];
					echo <<< Pictures
						<div class="item">
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
								<div class="review-image">
									<a href="$InstURL"">
									<img class="responsive-img" src="$imageURL" alt="Review">
									</a>
								</div>
							</div>
						</div>
Pictures;
				}
			?>
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