
<!-- <?php var_dump($data) ?> -->

<section class="s-nav">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<?
					if (LanguageSelect::$lang === "RU") {
						$FirstName = mb_strtoupper($data["path"]["RU"][0]);
						$SecondName = mb_strtoupper($data["path"]["RU"][1]);
						$ProductName = $SecondName . " #" . $data["main"]["id_product"];
						$Description = $data["main"]["description_ru"];
						$Material = "Материал: " . $data["main"]["material_ru"];
						$Price = $data["main"]["price_ru"] . " ₽";
					}
					else {
						$FirstName = mb_strtoupper($data["path"]["ENG"][0]);
						$SecondName = mb_strtoupper($data["path"]["ENG"][1]);
						$ProductName = $SecondName . " #" . $data["main"]["id_product"];
						$Description = $data["main"]["description_eng"];
						$Material = "Material: " . $data["main"]["material_eng"];
						$Price = $data["main"]["price_eng"] . " $";
					}  
					$FirstHref = "/product/" . $data["path"]["ENG"][0];
					$SecondHref = $FirstHref . "/" . $data["path"]["ENG"][1];
					echo "<a href=" . $FirstHref . ">" . $FirstName . "</a><i class=\"fa fa-angle-right\"></i>";
					echo "<a href=" . $SecondHref . ">" . $SecondName . "</a><i class=\"fa fa-angle-right\"></i>";
					echo $ProductName;
				?>
				<!-- <a href="#">Купальники</a><i class="fa fa-angle-right"></i> -->
				<!-- <a href="#">Раздельные</a><i class="fa fa-angle-right"></i> -->
				<!-- <a href="#">Трусики1</a> -->
			</div>
			<div class="col-md-7">
				
			</div>
		</div>
	</div>
</section>
<section class="product">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="photo">
					<div class="col-md-2">
						<div class="preview">
							<!-- <a href="#"><img class="responsive-img" src="/images/products_images/Photo6.jpg" alt="1"></a>
							<a href="#"><img class="responsive-img" src="/images/products_images/Photo9.jpg" alt="2"></a>
							<a href="#"><img class="responsive-img" src="/images/products_images/Photo13.jpg" alt="3"></a>
							<a href="#"><img class="responsive-img" src="/images/products_images/Photo9.jpg" alt="4"></a> -->

							<?

								for ($i = 0; $i < count($data["photos"]); $i++) {
									echo "<a href=\"#\"><img class=\"responsive-img\" src=\"/images/products_images/". 
										$data["photos"][$i] . "\"alt=" . ($i + 1) . "></a>";
								}

							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="view">
							<!-- <img class="big responsive-img" src="/images/products_images/Photo6.jpg" alt="Big photo"> -->
							<? 
								echo "<img class=\"big responsive-img\" src=\"/images/products_images/" . 
									$data["generalPhoto"] . "\"alt=\"Big photo\">"; 
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="details">
					<!-- <h3>Трусики 1</h3> -->
					<h3> <? echo $ProductName ?> </h3>
					<!-- <p class="d-title">Описание</p> -->
					<p class="d-title"> <? echo LanguageSelect::$templateData["Description"] ?> </p>
					<!-- <p class="description">Эти трусики лучше всего подойдут для вас. Так как они самые клевые. Когда вы их надете Вы станете милашкой.</p> -->
					<p class="description"> <? echo $Description ?> </p>
					<!-- <p class="material">Материал:  бифлекс. Состав: 80 % лайкра, 20 % спандекс.</p> -->
					<p class="material"><? echo $Material ?></p>
					<!-- <p class="price">4999 <span>₽</span></p> -->
					<p class="price"><? echo $Price ?></p>
					<!-- <p class="color"><span class="color-title">Цвет</span> <i class="fa fa-angle-right"></i> <span class="color-name">Розовый</span></p> -->
					<p class="color"><span class="color-title"><? echo LanguageSelect::$templateData["Color"] ?></span> <i class="fa fa-angle-right"></i> <span class="color-name">Розовый</span></p>
					<div class="color-circle">
						<a class="circle" href="#"><img src="/images/s_networks/circle.png" alt=""></a>
						<a class="circle" href="#"><img src="/images/s_networks/circle.png" alt=""></a>
						<a class="circle" href="#"><img src="/images/s_networks/circle.png" alt=""></a>
						<a class="circle" href="#"><img src="/images/s_networks/circle.png" alt=""></a>
						<a class="circle" href="#"><img src="/images/s_networks/circle.png" alt=""></a>
					</div>
					<!-- <p class="s-title">Размер</p> -->
					<p class="s-title"><? echo LanguageSelect::$templateData["Size"] ?></p>
					<div class="size">
						<a href="#"><span>38</span></a>
						<a href="#"><span>40</span></a>
						<a href="#"><span>42</span></a>
						<a href="#"><span>44</span></a>
					</div>
					<!-- <p class="status">Есть в наличии</p> -->
					<p class="status">
						<? 
							if ($data["main"]["quantity"] > 0) 
								echo LanguageSelect::$templateData["InAvailable"];
							else 
								echo LanguageSelect::$templateData["NoAvailable"]; 
						?>
					</p>
					<div class="button-add">
						<!-- <a href="#" class="button">Добавить в корзину</a> -->
						<? if ($data["main"]["quantity"] > 0) 
							echo "<button class=\"button\" onclick=\"addBasket()\">" . LanguageSelect::$templateData["Basket"] . "</button>";
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="carousel">
	<div class="container-fluid">
		<div class="row">
			<div class="carousel-shop">
				<div class="col-md-3">
					<div class="carousel-item">
						<a href="#"><img class="responsive-img" src="/images/products_images/Photo6.jpg" alt=""></a>
						<a href="#" class="button">Shop now</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="carousel-item">
						<a href="#"><img class="responsive-img" src="/images/products_images/Photo6.jpg" alt=""></a>
						<a href="#" class="button">Shop now</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="carousel-item">
						<a href="#"><img class="responsive-img" src="/images/products_images/Photo6.jpg" alt=""></a>
						<a href="#" class="button">Shop now</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="carousel-item">
						<a href="#"><img class="responsive-img" src="/images/products_images/Photo6.jpg" alt=""></a>
						<a href="#" class="button">Shop now</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>