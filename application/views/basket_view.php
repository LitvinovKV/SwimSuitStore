<section class="s-nav">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<a <? echo "href=/" . LanguageSelect::$lang . "/basket";?> ><? echo LanguageSelect::$templateData["BasketName"]; ?></a>
			</div>
		</div>
	</div>
</section>
<section class="s-steps">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="item-step">
					<a class="step tablink" onclick="openTab(event, 'Basket')" id="defaultOpen"><span class="number">1</span><span class="name"><?if (LanguageSelect::$lang === "RU") echo "Корзина"; else echo "Basket";?><br class="hidden-lg hidden-md"><?if (LanguageSelect::$lang === "RU") echo " товаров"; else echo " products";?></span></a>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="item-step">
					<a class="step tablink" onclick="openTab(event, 'Registration')"><span class="number">2</span><span class="name"><?if (LanguageSelect::$lang === "RU") echo "Оформление"; else echo "Ordering";?><br class="hidden-lg hidden-md"> <?if (LanguageSelect::$lang === "RU") echo " заказа"; else echo "";?></span></a>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="item-step">
					<a class="step tablink" onclick="openTab(event, 'Check')"><span class="number">3</span><span class="name"><?if (LanguageSelect::$lang === "RU") echo "Проверка"; else echo "Check";?><br class="hidden-lg hidden-md"> <?if (LanguageSelect::$lang === "RU") echo " заказа"; else echo " order";?></span></a>
				</div>
			</div>
		</div>
	</div>
</section>
<div id="Basket" class="tabcontent">
	<section class="s-titles">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 offset2"></div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="parameter-title">
						<? echo LanguageSelect::$templateData["BasketColumnFirst"]; ?>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="parameter-title">
					<? echo LanguageSelect::$templateData["BasketColumnSecond"]; ?>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="parameter-title">
					<? echo LanguageSelect::$templateData["BasketColumnThird"]; ?>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="parameter-title">
					<? echo LanguageSelect::$templateData["BasketColumnFourth"]; ?>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 offset2"></div>
				</div>
		</div>
	</section>

	<?
		$ColorAbbreviation = LanguageSelect::$templateData["Color"];
		$SizeAbbreviation = LanguageSelect::$templateData["Size"];

		if (array_key_exists("Basket", $_SESSION) === true) {
			$Basket = $_SESSION["Basket"];
			for ($i = 0; $i < count($Basket); $i++) {
				$idProduct = $Basket[$i]["id"];
				$sizeProduct = $Basket[$i]["size"];
				$countProduct = $Basket[$i]["count"];
				$colorProduct = $Basket[$i]["color"];
				$photoProduct = $Basket[$i]["photo"];
				if(LanguageSelect::$lang === "RU") {
					$summProduct = $countProduct * $Basket[$i]["priceRU"];
					$priceProduct = $Basket[$i]["priceRU"];
					$symbol = "₽";
				}
				else {
					$summProduct = $countProduct * $Basket[$i]["priceENG"];
					$priceProduct = $Basket[$i]["priceENG"];
					$symbol = "$";
				}
				echo <<< PRODUCT
				<section class="s-parameters">
				<div class="container">
					<div class="row">
						<div class="first-colomn col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<div class="p-item">
								<img class="responsive-img" src="/images/products_images/1.jpg" alt="Product">
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<div class="p-item text">
								<p class="name">Трусики1</p>
								<p><span>Цвет:<br class="hidden-lg hidden-md hidden-sm"></span><span class="color">Желтый</span></p>
								<p class="size"><span>Размер:</span><span class="size-value">xs</span></p>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<div class="p-item text">
								<p class="small"><span class="price">2800</span><span> руб</span></p>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<div class="p-item text quantity">
								<a class="small sign" href="#">–</a>
								<input type="text" value="1">
								<a class="small sign" href="#">+</a>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<div class="p-item text">
								<p class="small"><span class="sum">2800</span><span> руб</span></p>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<div class="p-item text">
								<a  class="small" href="#"><i class="fa fa-trash"></i></a>
							</div>
						</div>
					</div>
		
				</div>
			</section>
		
			<section class="s-parameters-small">
				<div class="container">
					<div class="row">
						<div class="first-colomn col-xs-6">
							<div class="p-item">
								<img class="responsive-img" src="/images/products_images/1.jpg" alt="Product">
							</div>
						</div>
						<div class="col-xs-6">
							<div class="p-items">
								<p class="name">Трусики1</p>
								<p><span>Цвет:</span><span class="color">Желтый</span></p>
								<p class="size"><span>Размер:</span><span class="size-value">xs</span></p>
								<p class="small"><span class="price">2800</span><span> руб</span></p>
								<div class="p-item text quantity">
									<a class="small sign" href="#">–</a>
									<input type="text" value="1">
									<a class="small sign" href="#">+</a>
								</div>
								<p class="small"><span class="sum">2800</span><span> руб</span></p>
								<a  class="small" href="#"><i class="fa fa-trash"></i></a>
							</div>
						</div>
					</div>
				</div>
			</section>
PRODUCT;
			}
		}
	?>
	
	<!-- <section class="s-parameters">
		<div class="container">
			<div class="row">
				<div class="first-colomn col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="p-item">
						<img class="responsive-img" src="/images/products_images/1.jpg" alt="Product">
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="p-item text">
						<p class="name">Трусики1</p>
						<p><span>Цвет:<br class="hidden-lg hidden-md hidden-sm"></span><span class="color">Желтый</span></p>
						<p class="size"><span>Размер:</span><span class="size-value">xs</span></p>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="p-item text">
						<p class="small"><span class="price">2800</span><span> руб</span></p>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="p-item text quantity">
						<a class="small sign" href="#">–</a>
						<input type="text" value="1">
						<a class="small sign" href="#">+</a>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="p-item text">
						<p class="small"><span class="sum">2800</span><span> руб</span></p>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="p-item text">
						<a  class="small" href="#"><i class="fa fa-trash"></i></a>
					</div>
				</div>
			</div>

		</div>
	</section>

	<section class="s-parameters-small">
		<div class="container">
			<div class="row">
				<div class="first-colomn col-xs-6">
					<div class="p-item">
						<img class="responsive-img" src="/images/products_images/1.jpg" alt="Product">
					</div>
				</div>
				<div class="col-xs-6">
					<div class="p-items">
						<p class="name">Трусики1</p>
						<p><span>Цвет:</span><span class="color">Желтый</span></p>
						<p class="size"><span>Размер:</span><span class="size-value">xs</span></p>
						<p class="small"><span class="price">2800</span><span> руб</span></p>
						<div class="p-item text quantity">
							<a class="small sign" href="#">–</a>
							<input type="text" value="1">
							<a class="small sign" href="#">+</a>
						</div>
						<p class="small"><span class="sum">2800</span><span> руб</span></p>
						<a  class="small" href="#"><i class="fa fa-trash"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section> -->

	<section class="s-results">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 offset6"></div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					<div class="result">
						<p class="title-sum">Subtotal</p>
						<button><? echo LanguageSelect::$templateData["BasketFirstButton"]; ?></button>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					<div class="result">
						<p class="result-sum">2800 <span>руб</span></p>
						<button class="registration"><? echo LanguageSelect::$templateData["BasketSecondButton"]; ?></button>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<div id="Registration" class="tabcontent">
	<section class="s-delivery">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="delivery">
						<span class="title"><? if (LanguageSelect::$lang === "RU") echo "ДОСТАВКА"; else echo "DELIVERY"; ?></span>
						<div class="delivery-types">
							<div class="radio-item">
								<div class="input-item">
									<input type="radio" name="post" value="sdek">
								</div>
								<div class="radio-name">
									<span class="sdek"> <?if (LanguageSelect::$lang === "RU") echo "СДЕК"; else echo "CDEK"; ?></span>
								</div>
							</div>
							<div class="radio-item">
								<div class="input-item">
									<input type="radio" name="post" value="post_ru" checked>
								</div>
								<div class="radio-name">
									<span class="post_ru"><? if (LanguageSelect::$lang === "RU") echo "ПОЧТА РОССИИ"; else echo "POST OF RUSSIA"; ?></span>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="s-contact">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<p class="c-title"><? if (LanguageSelect::$lang === "RU") echo "Контактная информация"; else echo "Contact information"; ?></p>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="block">
						<span class="required">*</span><input type="email" placeholder="E-mail" required>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="block">
					<?
						if (LanguageSelect::$lang === "RU") echo <<< PHONE
							<span class="required">*</span><input type="tel" placeholder="Номер телефона" required>						
PHONE;
						else
						echo <<< PHONE
							<span class="required">*</span><input type="tel" placeholder="Telephone number" required>						
PHONE;
					?>
						<!-- <span class="required">*</span><input type="tel" placeholder="Номер телефона" required> -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="s-delinfo">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<p class="d-title"><? if (LanguageSelect::$lang === "RU") echo "Информация для доставки"; else echo "Delivery Information"; ?></p>
				</div>
				<?
					if (LanguageSelect::$lang === "RU") {
						$name = "Имя";
						$country = "Страна";
						$adress = "Адрес";
						$secondName = "Фамилия";
						$city = "Город";
						$index = "Индекс";
						$comment = "Коментарий к заказу";
					}
					else {
						$name = "Name";
						$country = "Country";
						$adress = "Adress";
						$secondName = "Second Name";
						$city = "City";
						$index = "Index";
						$comment = "Comment to the order";
					}
				?>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="block">
						<span class="required">*</span><input type="text" placeholder="<?echo $name;?>" required>
					</div>
					<div class="block">
						<span class="required">*</span><input type="text" placeholder="<?echo $country;?>" required>
					</div>
					<div class="block">
						<span class="required">*</span><input type="text" placeholder="<?echo $adress;?>" required>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="block">
						<span class="required">*</span><input type="text" placeholder="<?echo $secondName;?>" required>
					</div>
					<div class="block">
						<span class="required">*</span><input type="text" placeholder="<?echo $city;?>" required>
					</div>
					<div class="block">
						<span class="required">*</span><input type="text" placeholder="<?echo $index?>" required>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="s-comment">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<textarea name="comment" class="comment" rows="4" placeholder="<?echo $comment?>"></textarea>
				</div>
			</div>
		</div>
	</section>
	<section class="s-button">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<button class="button-reg"><?echo LanguageSelect::$templateData["BasketSecondButton"];?></button>
				</div>
			</div>
		</div>
	</section>
</div>
<div id="Check" class="tabcontent">
	<section class="s-check">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<p class="phrase-left"><?if (LanguageSelect::$lang === "RU") echo "Для завершения заказа оплата не требуется"; else echo "To complete the order, no payment is required";?></p>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<p class="phrase-right"><strong><? if (LanguageSelect::$lang === "RU") echo "Важно!"; else echo "Attantion!"; ?> </strong><? if(LanguageSelect::$lang === "RU") echo "Проверьте контактную информацию"; else echo "Check contact information";?></p>
				</div>
			</div>
		</div>
	</section>
	<section class="s-button">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<button class="button-reg"><?echo LanguageSelect::$templateData["BasketThirdButton"];?></button>
				</div>
			</div>
		</div>
	</section>
</div>