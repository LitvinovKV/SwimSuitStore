var scr = {"scripts":[
    {"src" : "/js/libs.js", "async" : false},
    {"src" : "/js/common.js", "async" : false}
    ]};!function(t,n,r){"use strict";var c=function(t){if("[object Array]"!==Object.prototype.toString.call(t))return!1;for(var r=0;r<t.length;r++){var c=n.createElement("script"),e=t[r];c.src=e.src,c.async=e.async,n.body.appendChild(c)}return!0};t.addEventListener?t.addEventListener("load",function(){c(r.scripts);},!1):t.attachEvent?t.attachEvent("onload",function(){c(r.scripts)}):t.onload=function(){c(r.scripts)}}(window,document,scr);

// Отправка запроса на сервер, чтобы подписаться на рассылку новостей
// На вход : Название почты - EmailName, Действующий язык сайта - Language
// На выходе : сообщение об успешной операции.
function saveEmail(EmailName = document.getElementById("e-mail").value, 
    Language = document.getElementById("languageSelect").textContent) {

    // Если не было ничего введенено в text label
    if (EmailName.length === 0) {
        (Language === "RU") ? alert("Вы не ввели e-mail.") : alert("You didn't enter an e-mail.");
        return;
    }
    let XHR = new XMLHttpRequest();
    // Настроить GET запрос
    XHR.open("GET", "queries.php?EmailName=" + EmailName + "&Language=" + Language, false);
    // Отправить запрос
    XHR.send();
    // Если запрос имеет статус 200 (успешно обработан)
    if (XHR.status === 200)
        alert(XHR.responseText);

}

function increaseCountBasket() {
    let countBasket = document.getElementById("ProductCountInBasket");
    countBasket.textContent = ++countBasket.textContent;
}

function reduceCountBasket() {
    let countBasket = document.getElementById("ProductCountInBasket");
    countBasket.textContent = --countBasket.textContent;
}


// Реакция на нажатие кнопки "Добавить в корзину"
// Отсылает запрос на сервер, запрос на добавление товара в корзину
function addBasket() {
    increaseCountBasket();
    let productID = document.getElementById("hiddenIdProduct").textContent;
    let ProductSize = document.getElementById("NameSize").textContent;
    let ProductColor = document.getElementById("NameColor").textContent;
    let GeneralPhoto = document.getElementById("hiddenGeneralPhoto").textContent;
    let ProductPrice = document.getElementById("ProductPrice").textContent;
    if (ProductColor.length === 0 || ProductSize.length === 0) {
        alert("Вы не выбрали размер или цвет товара!");
        return;
    }
    let XHR = new XMLHttpRequest();
    console.log(productID);
    console.log(ProductSize);
    console.log(ProductColor);
    XHR.open("GET", "/queries.php?AddToBasketID=" + productID + "&AddToBasketSize=" + ProductSize + 
    "&AddToBasketColor=" + ProductColor + "&AddToBasketPhoto=" + GeneralPhoto + "&AddToBasketPrice=" + ProductPrice, false);
    XHR.send();
    if (XHR.status === 200)
        alert(XHR.responseText);
}

// Реакция на нажатие кнопки для выбора цвета в карточке продукта
function changeColor(NewColor) {
    document.getElementById("NameColor").textContent = NewColor;
}

function changeSize(NewSize) {
    document.getElementById("NameSize").textContent = NewSize;
}

// parametrs = [size_product, "color_product", "count_product"]
// count in HTML : class[...].childNodes[1].childNodes[1].childNodes[3].firstChild
function minusProduct(className, Parametrs, thisSymbol) {
    reduceCountBasket();
    let params = Parametrs.split('_');
    let id = className.split('_')[0];
    if (params[2] === 0) {
        alert("Ошибка / ERROR!");
        return;
    }

    let cls = document.getElementsByClassName(className);
    if (cls[0].childNodes[1].childNodes[1].childNodes[7].childNodes[1].childNodes[3].value <= 0 || 
        cls[1].childNodes[1].childNodes[1].childNodes[3].childNodes[1].childNodes[9].childNodes[3].value <= 0) {
        alert("Ошибка / Error!");
        return;
    }
    cls[0].childNodes[1].childNodes[1].childNodes[7].childNodes[1].childNodes[3].value--;
    cls[1].childNodes[1].childNodes[1].childNodes[3].childNodes[1].childNodes[9].childNodes[3].value--;

    // summ = price * count
    cls[0].childNodes[1].childNodes[1].childNodes[9].childNodes[1].childNodes[1].childNodes[0].textContent = 
        cls[0].childNodes[1].childNodes[1].childNodes[5].childNodes[1].childNodes[1].childNodes[0].textContent * 
        cls[0].childNodes[1].childNodes[1].childNodes[7].childNodes[1].childNodes[3].value;
    cls[1].childNodes[1].childNodes[1].childNodes[3].childNodes[1].childNodes[11].childNodes[0].textContent =
        cls[0].childNodes[1].childNodes[1].childNodes[9].childNodes[1].childNodes[1].childNodes[0].textContent;

    document.getElementsByClassName("result-sum")[0].textContent = 
        parseInt(document.getElementsByClassName("result-sum")[0].textContent) -
        parseInt(cls[0].childNodes[1].childNodes[1].childNodes[5].childNodes[1].childNodes[1].childNodes[0].textContent) + " " + thisSymbol;

    let XHR = new XMLHttpRequest();
    // Настроить POST запрос
    XHR.open("POST", "/queries.php", true);
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Отправить запрос
    let body = "DeleteFromBasketId=" + id + "&DeleteFromBasketSize=" + params[0] + "&DeleteFromBasketColor=" + params[1];
    XHR.send(body);

    }

function plusProduct(className, Parametrs, thisSymbol) {
    increaseCountBasket();
    let params = Parametrs.split('_');
    let id = className.split('_')[0];
    if (params[2] === 0) {
        alert("Ошибка / ERROR!");
        return;
    }

    let cls = document.getElementsByClassName(className);
    cls[0].childNodes[1].childNodes[1].childNodes[7].childNodes[1].childNodes[3].value++;
    cls[1].childNodes[1].childNodes[1].childNodes[3].childNodes[1].childNodes[9].childNodes[3].value++;

    // summ = price * count
    cls[0].childNodes[1].childNodes[1].childNodes[9].childNodes[1].childNodes[1].childNodes[0].textContent = 
        cls[0].childNodes[1].childNodes[1].childNodes[5].childNodes[1].childNodes[1].childNodes[0].textContent * 
        cls[0].childNodes[1].childNodes[1].childNodes[7].childNodes[1].childNodes[3].value;
    cls[1].childNodes[1].childNodes[1].childNodes[3].childNodes[1].childNodes[11].childNodes[0].textContent =
        cls[0].childNodes[1].childNodes[1].childNodes[9].childNodes[1].childNodes[1].childNodes[0].textContent;

    document.getElementsByClassName("result-sum")[0].textContent =
        parseInt(document.getElementsByClassName("result-sum")[0].textContent) +
        parseInt(cls[0].childNodes[1].childNodes[1].childNodes[5].childNodes[1].childNodes[1].childNodes[0].textContent) + " " + thisSymbol; 

    let XHR = new XMLHttpRequest();
    // Настроить POST запрос
    XHR.open("POST", "/queries.php", true);
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Отправить запрос
    let body = "AddProductInBasketId=" + id + "&AddProductInBasketSize=" + params[0] + "&AddProductInBasketColor=" + params[1];
    XHR.send(body);
}

function DeleteProduct(className, Parametrs, thisSymbol) {
    let params = Parametrs.split('_');
    let id = className.split('_')[0];
    classes = document.getElementsByClassName(className);
    let price = classes[0].childNodes[1].childNodes[1].childNodes[5].childNodes[1].childNodes[1].childNodes[0].textContent;
    // изменить счетчик кол-ва товарав возле иконки с корзиной
    let countBasket = document.getElementById("ProductCountInBasket");
    countBasket.textContent = countBasket.textContent - params[2];


    // Изменить итоговую сумму в корзине
    document.getElementsByClassName("result-sum")[0].textContent =
        (parseInt(document.getElementsByClassName("result-sum")[0].textContent) -
        (parseInt(classes[0].childNodes[1].childNodes[1].childNodes[5].childNodes[1].childNodes[1].childNodes[0].textContent) * 
        parseInt(classes[0].childNodes[1].childNodes[1].childNodes[7].childNodes[1].childNodes[3].value))) + " " + thisSymbol; 

    // удалить элементы из корзины визуально
    for (let i = 0; i < classes.length; i++) {
        classes[i].remove();
    }

    // отправить запрос на сервер, чтобы удалить продукт из корзины
    let XHR = new XMLHttpRequest();
    // Настроить POST запрос
    XHR.open("POST", "/queries.php", true);
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Отправить запрос
    let body = "DeleteProductInBasketId=" + id + "&DeleteProductInBasketSize=" + params[0] + "&DeleteProductInBasketColor=" + params[1];
    XHR.send(body);
}

function AddOrder(thisSymbol) {
    let email = document.getElementsByName("email")[0].value;
    let telephone = document.getElementsByName("telephone")[0].value;
    let name = document.getElementsByName("name")[0].value;
    let country = document.getElementsByName("country")[0].value;
    let adress = document.getElementsByName("adress")[0].value;
    let secondName = document.getElementsByName("secondName")[0].value;
    let city = document.getElementsByName("city")[0].value;
    let index = document.getElementsByName("index")[0].value;
    let description = document.getElementsByName("comment")[0].value;
    let resultSum = document.getElementsByName("resultSum")[0].outerText;
    let delivery = document.getElementsByName("post");
    for(i = 0; i < delivery.length; i++) {
        if (delivery[i].checked === true)
            delivery = delivery[i].value;
    }
    if(delivery === "post_ru") delivery = "Почта Росиии";
    else delivery = "CDEK";

    let countBasket = document.getElementById("ProductCountInBasket");
    countBasket.textContent = 0;

    if (email.length === 0 || telephone.length === 0 || name.length === 0 || country.length === 0 || 
        adress.length === 0 || secondName.length === 0 || city.length === 0 || index.length === 0 ||
        description.length === 0 || resultSum.length === 0) {
            alert("Вы не заполнили все поля для заказа! / You didn't enter all field for order!");
            return;
    }

    // отправить запрос на сервер, чтобы удалить продукт из корзины
    let XHR = new XMLHttpRequest();
    // Настроить POST запрос
    XHR.open("POST", "/queries.php", true);
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Отправить запрос
    let body = "AddOrderEmail=" + email + "&AddOrderTelephone=" + telephone + "&AddOrderName=" + name +
        "&AddOrderCountry=" + country + "&AddOrderAdress=" + adress + "&AddOrderSecondName=" + secondName + 
        "&AddOrderCity=" + city + "&AddOrderIndex=" + index + "&AddOrderDescription=" + description + 
        "&AddOrderTotalSumm=" + resultSum + "&AddOrderDelivery=" + delivery;
    XHR.send(body);
    XHR.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            //Удалить каждый товар в представлении корзины
            allProductsClasses = document.getElementsByClassName("allproducts");
            for(i = 0; i < allProductsClasses.length; i++) {
                allProductsClasses[i].remove();
            }
            // Очистить счетчик товара в корзине рядом с иконкой
            let countBasket = document.getElementById("ProductCountInBasket");
            countBasket.textContent = 0;
            // Сделать общую сумму покупки === 0
            document.getElementsByClassName("result-sum")[0].textContent = 0 + " " + thisSymbol;
            // Отправить новый запрос на удаление информации из сессии
            let XHR2 = new XMLHttpRequest();
            // Настроить POST запрос
            XHR2.open("POST", "/queries.php", true);
            XHR2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            // Отправить запрос
            let body = "ClearAllBaskets=" + email;
            XHR2.send(body);
        }
    };
}