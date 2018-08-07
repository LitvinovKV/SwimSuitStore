<!-- <? var_dump($data) ?> -->

<section class="s-nav">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<!-- <span>Swimwear</span> -->
				<span>
				<?
					$href = "/" . $data["HrefPath"][0] . "/" . $data["HrefPath"][1];
					$block = "";
					for ($i = 0; $i < count($data["PathContent"]); $i++) {
						$HrefName = mb_strtoupper($data["PathContent"][$i]);
						$href .= "/" . $data["HrefPath"][$i + 2];
						$block .= "<a href=\"" . $href . "\">" . $HrefName . "</a>";
						if ($i != count($data["PathContent"]) - 1)
							$block .= "<i class=\"fa fa-angle-right\"></i>";
					}
					echo $block;
				?>
				</span>
			</div>
			
			<!-- ФИЛЬТР ПОКА НЕ НУЖЕН! -->
			<!-- <div class="col-md-3">
				<div class="filter">
					<a href="#">Filter <i class="fa fa-caret-down"></i></a>
				</div>
			</div> -->
		</div>
	</div>
</section>
<section class="s-products">
	<div class="container-fluid">
		<div class="row">
			<div class="items">

				<?php

					for($i = 0; $i < count($data["Products"]); $i++) {
						
						// Если изоброжения у товара < 2, то его отображать не стоит  
						if (count($data["Products"][$i]["Photos"]) < 2) continue;
						
						$GeneralPhoto = $data["Products"][$i]["GeneralPhoto"];
						$href = "/" . LanguageSelect::$lang . "/productcard/" . $data["Products"][$i]["id_product"];
						echo <<<GENERAL_BLOCK_TOP
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<ul class="topmenu">
								<li>
									<ul class="submenu">
										<li><img class="hidden-img responsive-img" src="/images/products_images/$GeneralPhoto" alt="shop1" ></li>
									</ul>
									<div class="carousel-pr">
GENERAL_BLOCK_TOP;
						for ($j = 0; $j < count($data["Products"][$i]["Photos"]); $j++) {
							$PhotoName = $data["Products"][$i]["Photos"][$j];
							echo <<<CAROUSEL_BLOCK
								<div class="carousel-item">
									<a href=$href class="product-item">
										<img class="responsive-img" src="/images/products_images/$PhotoName" alt="shop1" >
									</a>
								</div>
CAROUSEL_BLOCK;
						}
						echo <<<GENERAL_BLOCK_BOTTOM
									</div>
								</li>
							</ul>
						</div>
GENERAL_BLOCK_BOTTOM;
					}

				?>
					<!-- <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						<ul class="topmenu">
							<li>
								<ul class="submenu">
									<li><img class="hidden-img responsive-img" src="/images/products_images/Photo13.jpg" alt="shop1" ></li>
								</ul>
								<div class="carousel-pr">
									<div class="carousel-item">
										<a href="#" class="product-item">
											<img class="responsive-img" src="/images/products_images/Photo9.jpg" alt="shop1" >
										</a>
									</div>
									<div class="carousel-item">
										<a href="#" class="product-item">
											<img class="responsive-img" src="/images/products_images/Photo6.jpg" alt="shop1" >
										</a>
									</div>
								</div>
							</li>
						</ul>
					</div> -->

				</div>
			</div>
		</div>
	</div>
</section>
				
<section class="s-nav">
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
</section>