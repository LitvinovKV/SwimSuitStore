<!-- <? var_dump($data) ?> -->

<section class="s-ref_point">
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
							$block .= "  >  ";
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
			
			<?php 
				for ($i = 0; $i < count($data["Products"]); $i++) {
					if ($data["Products"][$i]["quantity"] === true) {
						$href = "/productcard/" . $data["Products"][$i]["id_product"];
						$img = $data["Products"][$i]["photo"];
						echo <<<PRODUCT
							<div class="col-md-3">
								<div class="item">
									<a href=$href class="product-item">
										<img class="responsive-img" src="/images/products_images/$img" alt="shop1" >
									</a>
								</div>
							</div>
PRODUCT;
					}
				}
			?>

			<!-- <div class="items">
				<div class="col-md-3">
					<div class="item">
						<a href="#" class="product-item">
							<img class="responsive-img" src="/images/products_images/shop1.jpg" alt="shop1" >
						</a>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="item">
						<a href="#" class="product-item">
							<img class="responsive-img" src="/images/products_images/shop2.jpg" alt="shop2" >
						</a>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="item">
						<a href="#" class="product-item">
							<img class="responsive-img" src="/images/products_images/shop3.jpg" alt="shop3" >
						</a>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="item">
						<a href="#" class="product-item">
							<img class="responsive-img" src="/images/products_images/shop1.jpg" alt="shop1" >
						</a>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="item">
						<a href="#" class="product-item">
							<img class="responsive-img" src="/images/products_images/shop2.jpg" alt="shop2" >
						</a>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="item">
						<a href="#" class="product-item">
							<img class="responsive-img" src="/images/products_images/shop3.jpg" alt="shop3" >
						</a>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="item">
						<a href="#" class="product-item">
							<img class="responsive-img" src="/images/products_images/shop1.jpg" alt="shop1" >
						</a>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="item">
						<a href="#" class="product-item">
							<img class="responsive-img" src="/images/products_images/shop2.jpg" alt="shop3" >
						</a>
					</div>
				</div>
				</div>
			</div> -->
			
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