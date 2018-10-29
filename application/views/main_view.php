<section class="s-banner">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="carousel-images">

					<?php 
						$buttonTitle = LanguageSelect::$templateData["GeneralBannerButton"];
						$href = "/" . LanguageSelect::$lang . "/product/swimwear";
						for ($i = 0; $i < count($data["banners"]); $i++) {
							$path = "/images/general_images/" . $data["banners"][$i];
							echo <<<BANNERS
								<div class="item" data-merge="6">
									<img src="$path" alt="carousel">
									<a href="$href" class="button">$buttonTitle</a>
								</div>
BANNERS;
						}
					?>
				
				</div>
			</div>
		</div>
	</div>
</section>

<section class="s-slogan">
	<p>You never get a second chance to make a first impression</p>
</section>

<section class="s-shops">
	<div class="container-fluid">
		<div class="row">

		<?php
				$buttonTitle = LanguageSelect::$templateData["GeneralProductButton"];
				for ($i = 0; $i < count($data["hits"]); $i++) {
					$href = "/" . LanguageSelect::$lang . "/productcard/" . $data["hits"][$i]["id_product"];
					$path = "/images/products_images/" . $data["hits"][$i]["name"];
					echo <<<HITS
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<div class="shop">
								<img class="responsive-img" src="$path" alt="shop1">
								<div class="button-item">
									<a href="$href" class="button">$buttonTitle</a>
								</div>
							</div>
						</div>
HITS;
				}
			?>

		</div>
	</div>
				
</section>

					 	
<section class="s-video">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<!-- НАДО СДЕЛАТЬ ТАК ЧТОБЫ РАЗМЕРЫ ИЗМЕНЯЛИСЬ ОТНОСИТЕЛЬНО ЭКРАНА (СДЕЛАТЬ АДАПТИВНО) -->
				<div class="video-item">
					<iframe src="https://www.youtube.com/embed/igSZw4Zq8jA" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="s-join">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<img src="/images/general_images/<? echo $data["bottom"] ?>"alt="join">
				<div>
					<a href="https://www.instagram.com/swiund/" class="button"><? echo LanguageSelect::$templateData["GeneralJoinButton"]?>@SWIUND</a>
				</div>
			</div>
		</div>
	</div>
	
</section>