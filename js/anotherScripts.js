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


function addBasket() {
    let Flag = true;
    let XHR = new XMLHttpRequest();
    XHR.open("GET", "/queries.php?SessionTest=" + Flag, false);
    XHR.send();
    if (XHR.status === 200)
        alert(XHR.responseText);
}