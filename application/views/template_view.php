<html>
<head>
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge" >
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="/css/cssBootstrap.css"/>
    <script src="/js/anotherScripts.js"></script>
    <title>Swim Suit Store </title>
</head>
<body>
        
        <header>
            <div class="lang_line">
                <div class="container">
                    <div class="row">
                        <div class="col-md-11"></div>
                        <div class="col-md-1">
                                
                                <div class="languages">
                                        <a href="#" class="ru">RU</a>
                                        <a href="#">EN</a>
                                </div>
                        </div>
                            
                    </div>
                </div>
            </div>
            <div class="main_line">
                    
                <div class="container">
                    <div class="row">
                            
                        <div class="col-md-3">
                                <div class="s_networks">
                                        <a href="#" class="vk"><img class="img-svg" src="/images/s_networks/icon-vk.svg" alt="Vkontakte"></a>
                                        <a href="#" class="insta"><img class="img-svg" src="/images/s_networks/icon-insta.svg" alt="Instagram"></a>
                                        <a href="#" class="fb"><img class="img-svg" src="/images/s_networks/icon-fb.svg" alt="Facebook"></a>
                                        <a href="#" class="wa"><img class="img-svg" src="/images/s_networks/icon-wa.svg" alt="Whatsap"></a>
                                </div>
                        </div>
                        <div class="col-md-7">
                                <div class="logo">
                                        <a href="#" class="lg"><h1>swim under</h1></a>
                                </div>
                        </div>
                        <div class="col-md-1 offset1"></div>
                        <div class="col-md-1">
                            <div class="basket">
                                <span>0</span>
                                <a href="#" class="bs"> <img class="img-svg" src="/images/s_networks/icon-basket.svg" alt="Baske"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mnu_line">
                <div class="container">
                    <div class="row">

                        <div class="col-md-2">
                            <ul class="topmenu">
                                <li><a href="#" class="first">SWIMWEAR <i class="fa fa-caret-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="">Слитные</a></li>
                                        <li><a href="">Раздельные</a></li>
                                        <li><a href="">Принтованные</a></li>
                                        <li><a href="">Однотонные</a></li>
                                        <li><a href="">Акции</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <ul class="topmenu">
                                <li><a href="#" class="swimwear">UNDERWEAR <i class="fa fa-caret-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="">Бюстгальтеры</a></li>
                                        <li><a href="">Трусы</a></li>
                                        <li><a href="">Боди</a></li>
                                        <li><a href="">Акции</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <a href="#">PATTERNS</a>
                        </div>
                        <div class="col-md-2">
                            <ul class="topmenu">
                                <li><a href="#" class="swimwear">FAQ <i class="fa fa-caret-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="">Условия оплаты</a></li>
                                        <li><a href="">Условия доставки</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <a href="#">RESPONSES</a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="last">ABOUT</a>
                        </div>
                        
                    </div>
                </div>
            </div>
                
        </header>
        
        <?php include "application/views/" . $contentView; ?>

        <footer>
                <div class="section-pink">
                        <div class="feedback">
                                <div class="container">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="subscription">
                                                    <p class="lable">ПОДПИШИТЕСЬ НА НОВОСТИ</p>
                                                    <div class="send-email">
                                                        <input type="text" name="e-mail" placeholder="Введите E-mail...">
                                                    </div>
                                                    <p class="dop">Узнавайте о новостях акциях!</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button class="button-arrow"><i class="fa fa-angle-right"></i></button>
                                            </div>
                                            <div class="col-md-4">
                                                    <div class="s_networks">
                                                        <p>МЫ В СОЦИАЛЬНЫХ СЕТЯХ</p>
                                                        <a href="#" class="vk"><img class="img-svg" src="/images/s_networks/icon-vk.svg" alt="Vkontakte"></a>
                                                        <a href="#" class="insta"><img class="img-svg" src="/images/s_networks/icon-insta.svg" alt="Instagram"></a>
                                                        <a href="#" class="fb"><img class="img-svg" src="/images/s_networks/icon-fb.svg" alt="Facebook"></a>
                                                        <a href="#" class="wa"><img class="img-svg" src="/images/s_networks/icon-wa.svg" alt="Whatsapp"></a>
                                                    </div>
                                            </div>
                                            <div class="col-md-1 offset1"></div>
                                        </div>
                                </div>
                        </div>
                        <div class="info">
                                <div class="container">
                                        <div class="row">
                                                <div class="col-md-12">
                                                        <p>СЛУЖБА ПОДДЕРЖКИ ПОКУПАТЕЛЕЙ</p>
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
</body>
</html>
