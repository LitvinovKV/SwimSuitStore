<section class="s-nav">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-md-5 col-sm-7 col-xs-12">
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
					echo "<a href=/" . LanguageSelect::$lang . $FirstHref . ">" . $FirstName . "</a><i class=\"fa fa-angle-right\"></i>";
					if ($SecondName != "ПРИНТЫ" && $SecondName != "PATTERNS")
						echo "<a href=/" . LanguageSelect::$lang . $SecondHref . ">" . $SecondName . "</a><i class=\"fa fa-angle-right\"></i>";
					echo $ProductName;
				?>
				<!-- <a href="#">Купальники</a><i class="fa fa-angle-right"></i> -->
				<!-- <a href="#">Раздельные</a><i class="fa fa-angle-right"></i> -->
				<!-- <a href="#">Трусики1</a> -->
			</div>
			<div class="col-lg-7 col-md-7 col-sm-5 col-xs-12">
				
			</div>
		</div>
	</div>
</section>
<section class="product">
	<div class="container">
		<div class="row">
				<div class="photo">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
						<div class="preview">
							<!-- <a href="#"><img class="responsive-img" src="/images/products_images/Photo6.jpg" alt="1"></a>
							<a href="#"><img class="responsive-img" src="/images/products_images/Photo9.jpg" alt="2"></a>
							<a href="#"><img class="responsive-img" src="/images/products_images/Photo13.jpg" alt="3"></a>
							<a href="#"><img class="responsive-img" src="/images/products_images/Photo9.jpg" alt="4"></a> -->

							<?php
								if ($SecondName != "ПРИНТЫ" && $SecondName != "PATTERNS") {
// 									$general = $data["generalPhoto"];
// 									echo <<< GENERALPHOTO
// 									<img class="demo responsive-img" src="/images/products_images/$general" onclick="currentSlide(1)"  id="defaultOpen" alt="4">						
// GENERALPHOTO;
									for($i = 0; $i < count($data["photos"]); $i++) {
										$photo = $data["photos"][$i];
										$number = $i + 1;
										echo <<< PHOTO
											<img class="demo responsive-img" src="/images/products_images/$photo" onclick="currentSlide($number)"  id="defaultOpen" alt="4">
PHOTO;
									}
								}

								else {
									for($i = 0; $i < count($data["photos"]); $i++) {
										$photo = $data["photos"][$i];
										$number = $i + 1;
										echo <<< PHOTO
											<img class="demo responsive-img" src="/images/products_images/$photo" onclick="currentSlide($number), colorFunction('$photo')"  id="defaultOpen" alt="4">
PHOTO;
									}
								}


							?>
							<!-- <img class="demo responsive-img" src="/images/products_images/Photo9.jpg" onclick="currentSlide(1)"  id="defaultOpen" alt="4">
							<img class="demo responsive-img" src="/images/products_images/Photo6.jpg" onclick="currentSlide(2)" alt="4">
							<img class="demo responsive-img" src="/images/products_images/Photo13.jpg" onclick="currentSlide(3)" alt="4">
							<img class="demo responsive-img" src="/images/products_images/Photo9.jpg" onclick="currentSlide(4)" alt="4"> -->

							<!-- <?

								for ($i = 0; $i < count($data["photos"]); $i++) {	
									echo "<a href=\"#\"><img class=\"responsive-img\" src=\"/images/products_images/". 
										$data["photos"][$i] . "\"alt=" . ($i + 1) . "></a>";
								}

							?>-->
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
						<div class="view">
							<?php
								// if ($SecondName != "ПРИНТЫ" && $SecondName != "PATTERNS") {
// 									$general = $data["generalPhoto"];
// 									echo <<< GENERALPHOTO
// 									<img class="big responsive-img" src="/images/products_images/$general" alt="Big photo">					
// GENERALPHOTO;
									for($i = 0; $i < count($data["photos"]); $i++) {
										$photo = $data["photos"][$i];
										echo <<< PHOTO
										<img class="big responsive-img" src="/images/products_images/$photo" alt="Big photo">
PHOTO;
									}
							?>

							<!-- <img class="big responsive-img" src="/images/products_images/Photo9.jpg" alt="Big photo">
							<img class="big responsive-img" src="/images/products_images/Photo6.jpg" alt="Big photo">
							<img class="big responsive-img" src="/images/products_images/Photo13.jpg" alt="Big photo">
							<img class="big responsive-img" src="/images/products_images/Photo9.jpg" alt="Big photo"> -->


							<!--<? 
								echo "<img class=\"big responsive-img\" src=\"/images/products_images/" . 
									$data["generalPhoto"] . "\"alt=\"Big photo\">"; 
							?>-->
						</div>
					</div>
				</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="details">
					<!-- <h3>Трусики 1</h3> -->
					<h3> <? echo $ProductName ?> </h3>
					<!-- <p class="d-title">Описание</p> -->
					<div class="d-title">
						<span> <? echo LanguageSelect::$templateData["Description"] ?> </span>
					</div>
					<!-- <p class="description">Эти трусики лучше всего подойдут для вас. Так как они самые клевые. Когда вы их надете Вы станете милашкой.</p> -->
					<p class="description"> <? echo $Description ?> </p>
					
					<!-- <p class="material">Материал:  бифлекс. Состав: 80 % лайкра, 20 % спандекс.</p> -->
					<? 
						if ($SecondName != "ПРИНТЫ" && $SecondName != "PATTERNS")
							echo "<p class='material'>" . $Material . "</p>";
						else
							echo "<p class='material'></p>"
					?>

					<!-- <p class="price">4999 <span>₽</span></p> -->
					<? 
						if ($SecondName != "ПРИНТЫ" && $SecondName != "PATTERNS")
							echo "<p class='price' id='ProductPrice'>" . $Price . "</p>";
						else
							echo "<p class='price' id='ProductPrice'></p>"
					?>

					<!-- <p class="color"><span class="color-title">Цвет</span> <i class="fa fa-angle-right"></i> <span class="color-name">Розовый</span></p> -->
					<p class="color"><span class="color-title"><? echo LanguageSelect::$templateData["Color"] ?></span> <i class="fa fa-angle-right"></i> <span class="color-name" id="NameColor"></span></p>
					
					<div class="color-circle">
						<!-- <a class="circle" href="#"><img src="/images/s_networks/circle.png" alt=""></a>
						<a class="circle" href="#"><img src="/images/s_networks/circle.png" alt=""></a>
						<a class="circle" href="#"><img src="/images/s_networks/circle.png" alt=""></a>
						<a class="circle" href="#"><img src="/images/s_networks/circle.png" alt=""></a>
						<a class="circle" href="#"><img src="/images/s_networks/circle.png" alt=""></a> -->
						
					<?php
						if ($SecondName != "ПРИНТЫ" && $SecondName != "PATTERNS") {
							for($i = 0; $i < count($data["colors"]); $i++) {
								$imageName = $data["colors"][$i]["name"];
								$imagePath = $data["colors"][$i]["image"];
								echo <<< COLORS
									<label>
										<input type='radio' value='1' name='radio_color' id="color_1"/>
										<img src="/images/s_networks/$imagePath" onclick="changeColor('$imageName')">
									</label>
COLORS;
							}
						}
							
					?>

						<!-- <label>
							<input type='radio' value='1' name='radio_color' id="color_1"/>
							<img src="/images/s_networks/circle.png" alt="hm1">
						</label>

						<label>
							<input type='radio' value='1' name='radio_color' id="color_1"/>
							<img src="/images/s_networks/circle.png" alt="hm2">
						</label> -->
					</div>

					<!-- <p class="s-title">Размер</p> -->
					<!-- <p class="s-title"><? echo LanguageSelect::$templateData["Size"] ?> <i class="fa fa-angle-right"></i> <span class="color-name" id="NameSize"></span></p> -->
					<? 
						if ($SecondName != "ПРИНТЫ" && $SecondName != "PATTERNS")
							echo "<p class='color'>" . LanguageSelect::$templateData["Size"] . " <i class='fa fa-angle-right'></i> <span class='color-name' id='NameSize'></span></p>";
					?>
					<div class="size">
						<div class="first-part">
							<?php
								if ($SecondName != "ПРИНТЫ" && $SecondName != "PATTERNS") {
									for($i = 0; $i < count($data["sizes"]); $i++) {
										$sizeName = $data["sizes"][$i];
										$value = $i + 1;
										echo <<< SIZE
											<div class="item-size">
												<input type='radio' value='$value' name='radio' id="size_$value" />
												<label for='size_$value' onclick="changeSize('$sizeName')"><span>$sizeName</span></label>
											</div>										
SIZE;
									}
								}
							?>

							<!-- <div class="item-size">
								<input type='radio' value='1' name='radio' id="size_1" />
        						<label for='size_1'><span>38</span></label>
							</div>

							<div class="item-size">
								<input type='radio' value='2' name='radio' id="size_2" />
								<label for='size_2'><span>40</span></label>
							</div>

							<div class="item-size">
								<input type='radio' value='3' name='radio' id="size_3" />
								<label for='size_3'><span>XXS</span></label>
							</div> -->

							<!-- <div class="item-size"><a href="#"><span>XXS</span></a></div>
							<div class="item-size"><a href="#"><span>40</span></a></div>
							<div class="item-size"><a href="#"><span>XS</span><br></a></div>
							<div class="item-size"><a href="#"><span>42</span></a></div> -->
						</div>
						<!-- <div class="last-part">
							<div class="item-size"><a href="#"><span>S</span></a></div>
							<div class="item-size"><a href="#"><span>44</span></a></div>
							<div class="item-size"><a href="#"><span>M</span></a></div>
							<div class="item-size"><a href="#"><span>46</span></a></div>
							<div class="item-size"><a href="#"><span class="last">L</span></a></div>
						</div> -->
					</div>
					<!-- <p class="status">Есть в наличии</p> -->
					<p class="status">
						<? 
							if ($SecondName != "ПРИНТЫ" && $SecondName != "PATTERNS") {
								if ($data["main"]["quantity"] > 0) 
									echo LanguageSelect::$templateData["InAvailable"];
								else 
									echo LanguageSelect::$templateData["NoAvailable"]; 
							}
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
<section class="s-carousel">
	<div class="container">
		<div class="row">
			<div class="carousel-shop">
					
					<?php

						for($i = 0; $i < count($data["products"]); $i++) {
							// Если фотографий у товара < 2, то не отображать в карусели
							if (count($data["products"][$i]["photo"]) < 2) continue;

							$id = $data["products"][$i]["id"];
							// Пропустить товар с таким же айдишником (не отображать в каруселе товар, который
							// покупатель сейчас просматривает)
							if ($id === $data["main"]["id_product"]) continue;
							
							$photo = $data["products"][$i]["photo"];
							if (LanguageSelect::$lang === "RU")
								$href = "/RU/productcard/" . $id;
							else
								$href = "/ENG/productcard/" . $id;
							
							echo <<< PHOTO
								<div class="carousel-item">
								<img class="responsive-img" src="/images/products_images/$photo" alt="">
								<div class="button-item">
									<a href="$href" class="button">Shop now</a>
								</div>
							</div>
PHOTO;
						}

					?>

					<!-- <div class="carousel-item">
						<img class="responsive-img" src="/images/products_images/Photo6.jpg" alt="">
						<div class="button-item">
							<a href="#" class="button">Shop now</a>
						</div>
					</div>

					<div class="carousel-item">
						<img class="responsive-img" src="/images/products_images/Photo6.jpg" alt="">
						<div class="button-item">
							<a href="#" class="button">Shop now</a>
						</div>
					</div>

					<div class="carousel-item">
						<img class="responsive-img" src="/images/products_images/Photo6.jpg" alt="">
						<div class="button-item">
							<a href="#" class="button">Shop now</a>
						</div>
					</div>

					<div class="carousel-item">
						<img class="responsive-img" src="/images/products_images/Photo6.jpg" alt="">
						<div class="button-item">
							<a href="#" class="button">Shop now</a>
						</div>
					</div> -->

			</div>
		</div>
	</div>
	
	<span hidden="true" id="hiddenIdProduct"><? echo $data["main"]["id_product"] ?></span>
	<span hidden="true" id="hiddenGeneralPhoto"><? echo $data["generalPhoto"] ?></span>
</section>