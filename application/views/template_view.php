<?php session_start();
	// $_SESSION["Basket"] = [];

	// unset($_SESSION["count"]);
	// unset($_SESSION["Basket"]);

	// var_dump($_SESSION);

	// Удалить значение из сессии
	// unset($_SESSION["..."]);

	// Вывести время жизни сессии
	// var_dump(ini_get("session.gc_maxlifetime"));

	// ПРОБЛЕМА УДАЛЕНИЯ СЕССИЯ РАНЬШЕ НАЗНАЧЕННОГО ИМ СРОКА
	// var_dump($_SERVER['DOCUMENT_ROOT']);
	// var_dump(session_save_path());
?>
<html>
<head>
	<meta charset="utf-8" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0" >
	<meta http-equiv="X-UA-Compatible" content="ie=edge" >
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
	<link rel="stylesheet" type="text/css" href="/css/main_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/product_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/productcard_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/payment_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/delivery_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/basket_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/guarantee_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/chart_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/patterncard_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/tailoring_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/about_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/reviews_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/404_view.css" />
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="/css/owl.carousel.css" />
	<link rel="stylesheet" type="text/css" href="/css/cssBootstrap.css"/>
	<script src="/js/anotherScripts.js"></script>
	<title>Swim Suit Store </title>
</head>
<body>
		<header>
			<div class="lang_line">
				<div class="container">
					<div class="row">
						<div class="col-lg-11 col-md-11 col-sm-10 col-xs-8 offset11 offset10 offset8"></div>
						<div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
								
								<div class="languages">
										<a href="RU" class="ru">RU</a>
										<a href="ENG">EN</a>
								</div>
						</div>
							
					</div>
				</div>
			</div>
			<div class="main_line">
					
				<div class="container">
					<div class="row">
							
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<div class="s_networks">
										<a href="https://vk.com/swiund" class="vk"><img class="img-svg" src="/images/s_networks/icon-vk.svg" alt="Vkontakte"></a>
										<a href="https://www.instagram.com/swiund/" class="insta"><img class="img-svg" src="/images/s_networks/icon-insta.svg" alt="Instagram"></a>
										<a href="https://www.facebook.com/swiund" class="fb"><img class="img-svg" src="/images/s_networks/icon-fb.svg" alt="Facebook"></a>
										<a href="https://api.whatsapp.com/send?phone=79998744766" class="wa"><img class="img-svg" src="/images/s_networks/icon-wa.svg" alt="Whatsap"></a>
								</div>
						</div>
						<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
								<div class="logo">
										<a <? echo "href=/" . LanguageSelect::$lang ?> class="lg"><h1>swim under</h1></a>
								</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
							<div class="basket">
								<div class="shop-count"><span id="ProductCountInBasket">
								<? 
									if (array_key_exists("count", $_SESSION) === false) 
										echo 0;
									else
										echo $_SESSION["count"];  
								?>
								</span></div>
								<div class="basket-img">
									<a <?echo "href=/" . LanguageSelect::$lang . "/basket" ?> class="bs"><img class="img-svg" src="/images/s_networks/icon-basket.svg" alt="Baske"></a>
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<a href="#" class="toggle-mnu hidden-lg hidden-md hidden-sm"><span></span></a>
						</div>
						<div class="col-xs-12">
							<nav class="hidden-mnu hidden-lg hidden-md hidden-sm">
								<ul>
									<li>
										<ul class="topmenu">
											<li><a <? echo "href=/". LanguageSelect::$lang . "/product/swimwear"?> class="first">
													<? echo LanguageSelect::$templateData['SwimWearCatName']['Name']; ?> <i class="fa fa-caret-down"></i>
												</a>
												<ul class="submenu">
													<?
														for ($i = 0; $i < count(LanguageSelect::$templateData['SwimWearCatName']['Elements']); $i++)
															echo "<li><a href=/" . LanguageSelect::$lang . "/product/swimwear/" 
															. LanguageSelect::$templateData['SwimWearCatName']['Hrefs'][$i] . ">" 
															. LanguageSelect::$templateData['SwimWearCatName']['Elements'][$i] . "</a></li>";
													?>
												</ul>
											</li>
										</ul>
									</li>
									<li>
										<ul class="topmenu">
											<li><a <? echo "href=/" . LanguageSelect::$lang . "/product/underwear" ?> class="swimwear"> 
													<? echo LanguageSelect::$templateData['UnderWearCatName']['Name']; ?> <i class="fa fa-caret-down"></i>
												</a>
												<ul class="submenu">
													<?
														for ($i = 0; $i < count(LanguageSelect::$templateData['UnderWearCatName']['Elements']); $i++)
															echo "<li><a href=/" . LanguageSelect::$lang . "/product/underwear/" 
															. LanguageSelect::$templateData['UnderWearCatName']['Hrefs'][$i] . ">" 
															. LanguageSelect::$templateData['UnderWearCatName']['Elements'][$i] . "</a></li>"
													?>
												</ul>
											</li>
										</ul>
									</li>
									<li>
										<a <? echo "href=/" . LanguageSelect::$lang . "/product/patterns"?> > 
											<? echo LanguageSelect::$templateData['PatternsCatName']; ?> 
										</a>
									</li>
									<li>
										<ul class="topmenu">
											<li><a <? echo "href=/" . LanguageSelect::$lang . "/faq" ?> class="swimwear"> 
												<? echo LanguageSelect::$templateData['FAQCatName']['Name']; ?> <i class="fa fa-caret-down"></i></a>
												<ul class="submenu">
													<?
														for ($i = 0; $i < count(LanguageSelect::$templateData['FAQCatName']['Elements']); $i++)
															echo  "<li><a href=/" . LanguageSelect::$lang . "/faq/" . 
																LanguageSelect::$templateData['FAQCatName']['Hrefs'][$i] . 
																">" . LanguageSelect::$templateData['FAQCatName']['Elements'][$i] . "</a></li>";
													?>
												</ul>
											</li>
										</ul>
									</li>
									<li><a <? echo "href=/" . LanguageSelect::$lang . "/reviews" ?> > <? echo LanguageSelect::$templateData['ReviewsCatName']; ?> </a></li>
									<li><a <? echo "href=/" . LanguageSelect::$lang . "/about" ?> class="last"> <? echo LanguageSelect::$templateData['AboutCatName']; ?> </a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<div class="mnu_line">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
							<ul class="topmenu">
								<li><a <? echo "href=/". LanguageSelect::$lang . "/product/swimwear"?> class="first">
										<? echo LanguageSelect::$templateData['SwimWearCatName']['Name']; ?> <i class="fa fa-caret-down"></i>
									</a>
									<ul class="submenu">
										<?
											for ($i = 0; $i < count(LanguageSelect::$templateData['SwimWearCatName']['Elements']); $i++)
												echo "<li><a href=/" . LanguageSelect::$lang . "/product/swimwear/" 
												. LanguageSelect::$templateData['SwimWearCatName']['Hrefs'][$i] . ">" 
												. LanguageSelect::$templateData['SwimWearCatName']['Elements'][$i] . "</a></li>";
										?>
									</ul>
								</li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
							<ul class="topmenu">
								<li><a <? echo "href=/" . LanguageSelect::$lang . "/product/underwear" ?> class="swimwear"> 
										<? echo LanguageSelect::$templateData['UnderWearCatName']['Name']; ?> <i class="fa fa-caret-down"></i>
									</a>
									<ul class="submenu">
										<?
											for ($i = 0; $i < count(LanguageSelect::$templateData['UnderWearCatName']['Elements']); $i++)
												echo "<li><a href=/" . LanguageSelect::$lang . "/product/underwear/" 
												. LanguageSelect::$templateData['UnderWearCatName']['Hrefs'][$i] . ">" 
												. LanguageSelect::$templateData['UnderWearCatName']['Elements'][$i] . "</a></li>"
										?>
									</ul>
								</li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
							<a <? echo "href=/" . LanguageSelect::$lang . "/product/patterns"?> > 
								<? echo LanguageSelect::$templateData['PatternsCatName']; ?> 
							</a>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
							<ul class="topmenu">
								<li><a <? echo "href=/" . LanguageSelect::$lang . "/faq" ?> class="swimwear"> 
									<? echo LanguageSelect::$templateData['FAQCatName']['Name']; ?> <i class="fa fa-caret-down"></i></a>
									<ul class="submenu">
										<?
											for ($i = 0; $i < count(LanguageSelect::$templateData['FAQCatName']['Elements']); $i++)
												echo  "<li><a href=/" . LanguageSelect::$lang . "/faq/" . 
													LanguageSelect::$templateData['FAQCatName']['Hrefs'][$i] . 
													">" . LanguageSelect::$templateData['FAQCatName']['Elements'][$i] . "</a></li>";
										?>
									</ul>
								</li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
							<a <? echo "href=/" . LanguageSelect::$lang . "/reviews" ?> > <? echo LanguageSelect::$templateData['ReviewsCatName']; ?> </a>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
							<a <? echo "href=/" . LanguageSelect::$lang . "/about" ?> class="last"> <? echo LanguageSelect::$templateData['AboutCatName']; ?> </a>
						</div>
						
					</div>
				</div>
			</div>
			
		</header>
		
		<?php
			include "application/views/" . $contentView; 
		?>

		<footer>
				<div class="section-pink">
						<div class="feedback">
								<div class="container">
										<div class="row">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="subscription">
													<p class="lable"> <? echo LanguageSelect::$templateData['OtherSentences'][0]; ?> </p>
													<div class="send-email">
														<div class="input-item">
															<input type="email" id="e-mail" maxLength="75" placeholder="Введите E-mail...">
														</div>
														<div class="button-item">
															<button class="button-arrow" onClick="saveEmail()"><i class="fa fa-angle-right"></i></button>
														</div>
													</div>
													<p class="dop"> <? echo LanguageSelect::$templateData['OtherSentences'][1]; ?> </p>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="s_networks">
														<p class="hidden-xs"> <? echo LanguageSelect::$templateData['OtherSentences'][2]; ?> </p>
														<a href="https://vk.com/swiund" class="vk"><img class="img-svg" src="/images/s_networks/icon-vk.svg" alt="Vkontakte"></a>
														<a href="https://www.instagram.com/swiund/" class="insta"><img class="img-svg" src="/images/s_networks/icon-insta.svg" alt="Instagram"></a>
														<a href="https://www.facebook.com/swiund" class="fb"><img class="img-svg" src="/images/s_networks/icon-fb.svg" alt="Facebook"></a>
														<a href="https://api.whatsapp.com/send?phone=79998744766" class="wa"><img class="img-svg" src="/images/s_networks/icon-wa.svg" alt="Whatsapp"></a>
													</div>
											</div>
										</div>
								</div>
						</div>
						<div class="info">
								<div class="container">
										<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<p> <? echo LanguageSelect::$templateData['OtherSentences'][3]; ?> </p>
														<span>8 (999) 847-47-66</span>
														<span>pochtanepredumana@gmail.com</span>
												</div>
										</div>
								</div>
								
						</div>
				</div>
				
				<div class="end">
						<span><i class="fa fa-copyright"></i> 2018</span>
						<span>Build by Kirill Litvinov, Natali Antonenko</span>
				</div>
		</footer>

		<div hidden="true" id="languageSelect"><? echo LanguageSelect::$lang ?></div>
</body>
</html>
