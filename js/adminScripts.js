// Отобразить дочерние кнопоки при нажатии на родительскую кнопку
// Все остальные дочерние кнопки скрываются
function changeHidden(numberBlock) {
    hiddenFormsByClassName("AddForms");
    hiddenFormsByClassName("UpdateForms");
    hiddenFormsByClassName("DeleteForms");
    hiddenFormsByClassName("Orders");

    let buttons = document.getElementsByClassName("ButtonBlock");
    for (let i = 0; i < buttons.length; i++) {
        if (i === numberBlock)
            buttons[i].hidden = false;
        else {
            buttons[i].hidden = true;
        }
    }
}

// Отобразить только ту форму, которая идет под номером numberForm
// класса nameForm, а все остальные скрыть
function FormHidden(numberForm, nameForm) {
    let forms = document.getElementsByClassName(nameForm);
    console.log(forms);
    for (let i = 0; i < forms.length; i++) {
        if (i === numberForm)
            forms[i].hidden = false;
        else
            forms[i].hidden = true; 
    }
}

// Скрыть все формы доступные по имени класса
function hiddenFormsByClassName(formsName) {
    let forms = document.getElementsByClassName(formsName);
    for (let i = 0; i < forms.length; i++)
        forms[i].hidden = true;
}


// function UploadProductPhoto() {
//     alert("hmmmmm");
// }