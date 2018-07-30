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

// Ф-ия для отправки однотипных простых запросов на сервер
function sendSimpleHTTP(ParamName, ParamValue) {
    let XHR = new XMLHttpRequest();
    // Настроить POST запрос
    XHR.open("POST", "/adminpanel_queries.php", true);
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Отправить запрос
    let body = ParamName +  "=" + ParamValue;
    XHR.send(body);
    // Если запрос имеет статус 200 (успешно обработан)
    XHR.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
}

// Ф-ия для отправки однотипных запросов с двумя параметрами на сервер
function sendSimpleDoubleHTTP(FirstParamName, FirstParamValue, SecondParamName, SecondParamValue) {
    let XHR = new XMLHttpRequest();
    // Настроить POST запрос
    XHR.open("POST", "/adminpanel_queries.php", true);
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Отправить запрос
    let body = FirstParamName + "=" + FirstParamValue + "&" + SecondParamName + "=" + SecondParamValue;
    XHR.send(body);
    // Если запрос имеет статус 200 (успешно обработан)
    XHR.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
}

// Отправить запрос на сервер, чтобы добавить новую категорию в БД
function addCategoryInDB(CategoryName = document.getElementById("AddCategoryName").value) {
    // Если не было ничего введенено в text label
    if (CategoryName.length === 0) {
        alert("Вы не ввели категорию.");
        return;
    }
    sendSimpleHTTP("CategoryName", CategoryName);
}

// Отправить запрос на сервер, чтобы добавить новую подкатегорию в БД
function addSubcategoryInDB(SubCategoryName = document.getElementById("AddSubcategoryName").value, 
    CategoryName = document.getElementById("SelectAddSubcategory").value) {
    // Если не было ничего введенено в text label
    if (SubCategoryName.length === 0 || CategoryName === "Выберите категорию") {
        alert("Вы не заполнили форму.");
        return;
    }
    sendSimpleDoubleHTTP("SubCategoryName", SubCategoryName, "CategoryNameforSub", CategoryName);
}

// Отправить запрос на сервер, чтобы добавить новый цвет в БД
function addColorInDB(ColorName = document.getElementById("AddNewColor").value) {
    // Если не было ничего введенено в text label
    if (ColorName.length === 0) {
        alert("Вы не ввели категорию.");
        return;
    }
    sendSimpleHTTP("ColorName", ColorName);
}

// Отправить запрос на сервер, чтобы добавить новый размер в БД
function addSizeInDB(SizeName = document.getElementById("AddNewSize").value) {
    // Если не было ничего введенено в text label
    if (SizeName.length === 0) {
        alert("Вы не ввели категорию.");
        return;
    }
    sendSimpleHTTP("SizeName", SizeName);
}

// Отправить запрос на сервер, чтобы добавить новый продукт в БД
function AddProductInDB(DescriptRU = document.getElementsByName("AddDescribeProductRU")[0].value, 
    DescriptENG = document.getElementsByName("AddDescribeProductENG")[0].value, 
    MaterialRU = document.getElementsByName("AddMaterialProductRU")[0].value,
    MaterialENG = document.getElementsByName("AddMaterialProductENG")[0].value,
    PriceRU = document.getElementsByName("AddPriceProductRU")[0].value, 
    PriceENG = document.getElementsByName("AddPriceProductENG")[0].value,
    CountProduct = document.getElementsByName("AddCountProduct")[0].value) {
    if (DescriptRU.length === 0 || DescriptENG.length === 0 || MaterialRU.length === 0 || MaterialENG.length === 0 
        || PriceRU.length === 0 || PriceENG.length === 0 || CountProduct.length === 0) {
            alert("Вы Не заполнини форму");
            return;
        }
        let XHR = new XMLHttpRequest();
        // Настроить POST запрос
        XHR.open("POST", "/adminpanel_queries.php", true);
        XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        // Отправить запрос
        let body = "AddProductDescribeRu=" + DescriptRU + "&AddProductDescribeEng=" + DescriptENG + 
            "&AddProductMaterialRu=" + MaterialRU + "&AddProductMaterialEng=" + MaterialENG + 
            "&AddProductPriceRu=" + PriceRU + "&AddProductPriceEng=" + PriceENG + "&AddProductCount=" + CountProduct;
        XHR.send(body);
        // Если запрос имеет статус 200 (успешно обработан)
        XHR.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
            }
        };
}

// Отправить запрос на сервер, чтобы добавить запись в табилцу БД для связи М:М (подкатегори - продукт)
function AddProductAndSubcategoryInDB(SubcategoryName = document.getElementsByName("AddSubcategoryName")[0].value,
    ProdcutId = document.getElementsByName("AddSubcategoryProductId")[0].value) {

        if (SubcategoryName.length === 0 || ProdcutId === 0) {
            alert("Вы не заполнили форму!");
            return;
        }

        sendSimpleDoubleHTTP("AddSubcategoryNameForProduct", SubcategoryName, "AddSubcategoryIdProduct", ProdcutId);
}

// Отправить запрос на сервер, чтобы добавить запись в табилцу БД для связи М:М (цвет - продукт)
function AddColorForProduct(ColorName = document.getElementsByName("AddColorNameForProduct")[0].value,
    ProductId = document.getElementsByName("AddProductIdForColor")[0].value) {

        if (ColorName.length === 0 || ProductId === 0) {
            alert("Вы не заполнили форму!");
            return;
        }

        sendSimpleDoubleHTTP("AddColorNameForProduct", ColorName, "AddProductIdForColor", ProductId);
}

function AddSizeForProduct(SizeName = document.getElementsByName("AddSizeNameForProduct")[0].value,
    ProductId = document.getElementsByName("AddProductIdForSize")[0].value) {
        if (SizeName.lengt === 0 || ProductId === 0) {
            alert("Вы не заполнили форму!");
            return;
        }

        sendSimpleDoubleHTTP("AddSizeNameForProduct", SizeName, "AddProductIdForSize", ProductId);
}