<section class="s-nav">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<a href="#">Корзина</a>
			</div>
		</div>
	</div>
</section>
<section class="s-steps">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="item-step">
					<a class="step tablink" onclick="openTab(event, 'Basket')" id="defaultOpen"><span class="number">1</span><span class="name">Корзина<br class="hidden-lg hidden-md"> товаров</span></a>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="item-step">
					<a class="step tablink" onclick="openTab(event, 'Registration')"><span class="number">2</span><span class="name">Оформление<br class="hidden-lg hidden-md"> заказа</span></a>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="item-step">
					<a class="step tablink" onclick="openTab(event, 'Check')"><span class="number">3</span><span class="name">Проверка<br class="hidden-lg hidden-md"> заказа</span></a>
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
						Product
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="parameter-title">
						Price
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="parameter-title">
						Quantity
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="parameter-title">
						Subtotal
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 offset2"></div>
				</div>
		</div>
	</section>
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
	<section class="s-results">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 offset6"></div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					<div class="result">
						<p class="title-sum">Subtotal</p>
						<button>Обновить корзину</button>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					<div class="result">
						<p class="result-sum">2800 <span>руб</span></p>
						<button class="registration">Оформление заказа</button>
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
					<p class="delivery">
						<span class="title">Доставка <br class="hidden-lg hidden-md hidden-sm"></span>
						<input type="radio" name="post" value="sdek"><span class="sdek">Сдек</span>
						<input type="radio" name="post" value="post_ru" checked><span class="post_ru">Почта России</span>
					</p>
				</div>
			</div>
		</div>
	</section>
	<section class="s-contact">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<p class="c-title">Контактная информация</p>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="block">
						<span class="required">*</span><input type="email" placeholder="E-mail" required>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="block">
						<span class="required">*</span><input type="tel" placeholder="Номер телефона" required>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="s-delinfo">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<p class="d-title">Информация для доставки</p>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="block">
						<span class="required">*</span><input type="text" placeholder="Имя" required>
					</div>
					<div class="block">
						<span class="required">*</span><input type="text" placeholder="Страна" required>
					</div>
					<div class="block">
						<span class="required">*</span><input type="text" placeholder="Адрес" required>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="block">
						<span class="required">*</span><input type="text" placeholder="Фамилия" required>
					</div>
					<div class="block">
						<span class="required">*</span><input type="text" placeholder="Город" required>
					</div>
					<div class="block">
						<span class="required">*</span><input type="text" placeholder="Индекс" required>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="s-comment">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<textarea name="comment" class="comment" rows="4" placeholder="Комментарий"></textarea>
				</div>
			</div>
		</div>
	</section>
	<section class="s-button">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<button class="button-reg">Оформление заказа</button>
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
					<p class="phrase-left">Для завершения заказа оплата не требуется</p>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<p class="phrase-right"><strong>Важно! </strong>Проверьте контактную информацию</p>
				</div>
			</div>
		</div>
	</section>
	<section class="s-button">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<button class="button-reg">Оформить заказ</button>
				</div>
			</div>
		</div>
	</section>
</div>