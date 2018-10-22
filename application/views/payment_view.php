<section class="s-nav">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?
					echo "<a href='/" . LanguageSelect::$lang . "/faq'>FAQ</a><i class='fa fa-angle-right'></i>";
					echo "<a href='/" . LanguageSelect::$lang . "/faq/payment'>" . 
						((LanguageSelect::$lang === "RU") ? "Условия оплаты" : "terms of payment") . "</a>";
				?>
			</div>
		</div>
	</div>
</section>
<section class="s-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<p class="text">
					В данный момент при оформлении заказа доступен только безналичный расчет. В дальнейшем, будут доступны и другие методы оплаты.
				</p>
			</div>
		</div>
	</div>
</section>