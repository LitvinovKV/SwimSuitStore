
<!-- <? var_dump($data); ?> --!>



<section class="s-carousel">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
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
					
					<!-- <div class="item" data-merge="6">
						<img src="/images/general_images/carousel.jpg" alt="carousel">
						<a href="#" class="button">View all</a>
					</div>
					<div class="item" data-merge="6">
						<img src="/images/general_images/carousel.jpg" alt="carousel">
						<a href="#" class="button">View all</a>
					</div>
					<div class="item" data-merge="6">
						<img src="/images/general_images/carousel.jpg" alt="carousel">
						<a href="#" class="button">View all</a>
					</div>
					<div class="item" data-merge="6">
						<img src="/images/general_images/carousel.jpg" alt="carousel">
						<a href="#" class="button">View all</a>
					</div> -->
				
				</div>
			</div>
		</div>
	</div>
</section>

<section class="s-slogan">
	<p>You never get a second chance to make a first impression</p>
</section>

<section class="s-shop">
	<div class="container-fluid">
		<div class="row">

			<?php
				$buttonTitle = LanguageSelect::$templateData["GeneralProductButton"];
				$href = "#";
				for ($i = 0; $i < count($data["hits"]); $i++) {
					$path = "/images/products_images/" . $data["hits"][$i]["name"];
					echo <<<HITS
						<div class="col-md-4 col-sm-6">
							<div class="shop1">
								<img src="$path" alt="shop1">
								<div>
									<a href="$href" class="button">$buttonTitle</a>
								</div>
							</div>
						</div>
HITS;
				}
			?>

			<!-- <div class="col-md-4 col-sm-6">
				<div class="shop1">
					<img src="/images/products_images/shop1.jpg" alt="shop1">
					<div>
						<a href="#" class="button">SHOP NOW</a>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-6">
				<div class="shop2">
					<img src="/images/products_images/shop2.jpg" alt="shop2">
					<div>
						<a href="#" class="button">SHOP NOW</a>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-6">
				<div class="shop3">
					<img src="/images/products_images/shop3.jpg" alt="shop3">
					<div>
						<a href="#" class="button">SHOP NOW</a>
					</div>
				</div>
			</div> -->

		</div>
	</div>
				
</section>

<section class="s-video">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<video controls="controls" poster="/images/general_images/video.jpg">
					<source src="/images/video/video1.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
					<source src="/images/video/video1.mp4" type='video/ogg; codecs="theora, vorbis"'>
   					<source src="/images/video/video1.mp4" type='video/webm; codecs="vp8, vorbis"'>
				 	Тег video не поддерживается вашим браузером. 
   				<a href="/images/video/video1.mp4">Скачайте видео</a>
				</video>
			</div>
		</div>
	</div>
</section>

<section class="s-join">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<img src="/images/general_images/<? echo $data["bottom"] ?>"alt="join">
				<div>
					<a href="https://www.instagram.com/swiund/" class="button"><? echo LanguageSelect::$templateData["GeneralJoinButton"]?>@SWIUND</a>
				</div>
			</div>
		</div>
	</div>
	
</section>