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

// Отправить запрос на сервер, чтобы добавить запись втаблицу БД для связи М:М (размер - продукт)
function AddSizeForProduct(SizeName = document.getElementsByName("AddSizeNameForProduct")[0].value,
    ProductId = document.getElementsByName("AddProductIdForSize")[0].value) {
        if (SizeName.length === 0 || ProductId === 0) {
            alert("Вы не заполнили форму!");
            return;
        }

        sendSimpleDoubleHTTP("AddSizeNameForProduct", SizeName, "AddProductIdForSize", ProductId);
}

// Ф-ия отлавливающая изменения в select и задающая значения в определенный input text
function changeJS(Value, IdInputText) {
    IdInputText.value = Value;
}

function RedactSubcategoryName(ChangedSubcategoryName = document.getElementsByName("ChangedSubcategoryName")[0].value,
    OldestSubcategoryName = document.getElementsByName("OldestSubcategoryName")[0].value) {
    if (ChangedSubcategoryName.length === 0 || OldestSubcategoryName.length === 0) {
        alert("Вы не заполнили форму!");
        return;
    }

    sendSimpleDoubleHTTP("RedactSubcategoryName", ChangedSubcategoryName, "OldestSubcategoryName", OldestSubcategoryName);
}

// Ф-ия для отправки запроса на сервер, чтобы редактировать название категории
function RedactCategoryName(ChangedCategoryName = document.getElementsByName("ChangedCategoryName")[0].value, 
    OldestCategoryName = document.getElementsByName("OldestCategoryName")[0].value) {
    if (ChangedCategoryName.length === 0 || OldestCategoryName.length === 0) {
        alert("Вы не заполнили форму!");
        return;
    }
    
    sendSimpleDoubleHTTP("RedactCategoryName", ChangedCategoryName, "OldCategoryName", OldestCategoryName);
}

// Ф-ия отправки запроса на сервер, чтобы редактировать название цвета в БД
function RedactColorName(ChangedColorName = document.getElementsByName("ChangedColorName")[0].value,  
    OldColorName = document.getElementsByName("OldColorName")[0].value) {
    if (ChangedColorName.length === 0 || OldColorName.length === 0) {
        alert("Вы не заполнили форму!");
        return;
    }

    sendSimpleDoubleHTTP("RedactColorName", ChangedColorName, "OldColorName", OldColorName);
}

// Ф-ия отправки запроса на сервер, чтобы редактировать название размера в БД
function RedactSizeName(ChangedSizeName = document.getElementsByName("ChangedSizeName")[0].value, 
    OldSizeName = document.getElementsByName("OldSizeName")[0].value) {
    if (ChangedSizeName.length === 0 || OldSizeName.length === 0) {
        alert("Вы не заполнили форму!");
        return;
    }

    sendSimpleDoubleHTTP("RedcactSizeName", ChangedSizeName, "OldSizeName", OldSizeName);
}

// Ф-ия отправки запроса на сервер, чтобы получитаь данные о товара по идентификатору
function selectProduct(Id_product = document.getElementsByName("ChangedIdProduct")[0].value) {
    if (Id_product.length === 0) {
        alert("Вы не заполнили форму!");
        return;
    }

    let XHR = new XMLHttpRequest();
    // Настроить POST запрос
    XHR.open("POST", "/adminpanel_queries.php", true);
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Отправить запрос
    let body = "InformationAboutProductById=" + Id_product;
    XHR.send(body);
    // Если запрос имеет статус 200 (успешно обработан)
    XHR.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // alert(this.responseText);
            let result = this.responseText.split("||");
            // alert(result);
            document.getElementsByName("ChangedDescProductRU")[0].value = result[1];
            document.getElementsByName("ChangedDescProductENG")[0].value = result[2];
            document.getElementsByName("ChangedDescMaterialProductRU")[0].value = result[3];
            document.getElementsByName("ChangedDescMaterialProductENG")[0].value = result[4];
            document.getElementsByName("ChangedPriceProductRU")[0].value = result[5];
            document.getElementsByName("ChangedPriceProductENG")[0].value = result[6];
            document.getElementsByName("ChangedQuanityProduct")[0].value = result[7];
        }
    }
}

// Ф-ия для отправки запроса на сервер, чтобы изменить данные продукта 
// откоректированные в форме администратором
function RedactInformationAboutlProduct(ChangedIdProduct = document.getElementsByName("ChangedIdProduct")[0].value, 
    ChangedDescProductRu = document.getElementsByName("ChangedDescProductRU")[0].value, 
    ChangedDescProductEng = document.getElementsByName("ChangedDescProductENG")[0].value,
    ChangedDescMaterialProductRu = document.getElementsByName("ChangedDescMaterialProductRU")[0].value,
    ChangedDescMaterialProductEng = document.getElementsByName("ChangedDescMaterialProductENG")[0].value,
    ChangedPriceProductRu = document.getElementsByName("ChangedPriceProductRU")[0].value,
    ChangedPriceProductEng = document.getElementsByName("ChangedPriceProductENG")[0].value,
    ChangedQuantityProduct = document.getElementsByName("ChangedQuanityProduct")[0].value) {

    if (ChangedIdProduct.length === 0 || ChangedDescProductRu.length === 0 || ChangedDescProductEng.length === 0 ||
        ChangedDescMaterialProductRu.length === 0 || ChangedDescMaterialProductEng.length === 0 || 
        ChangedPriceProductRu.length === 0 || ChangedPriceProductEng.length === 0 || ChangedQuantityProduct.length === 0) {
        
        alert("Вы не заполнили форму!");
        return;
    }


    let XHR = new XMLHttpRequest();
    // Настроить POST запрос
    XHR.open("POST", "/adminpanel_queries.php", true);
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Отправить запрос
    let body = "ChangedInformationProductId=" + ChangedIdProduct +
        "&ChangedInformationProductDescRu=" + ChangedDescProductRu +
        "&ChangedInformationProductDescEng=" + ChangedDescProductEng +
        "&ChangedInformationProductMaterialDescRu=" + ChangedDescMaterialProductRu +
        "&ChangedInformationProductMaterialDescEng=" + ChangedDescMaterialProductEng +
        "&ChangedInformationProductPriceRu=" + ChangedPriceProductRu +
        "&ChangedInformationProductPriceEng=" + ChangedPriceProductEng +
        "&ChangedInformationProductQuantity=" + ChangedQuantityProduct;
    XHR.send(body);
    // Если запрос имеет статус 200 (успешно обработан)
    XHR.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
}

// Ф-ия которая отправляет запрос на добавление нового хита в БД
function AddNewProductHit(IdProductHit = document.getElementsByName("AddProductHit")[0].value) {
    if (IdProductHit.length === 0) {
        alert("Вы не заполнили форму!");
        return;
    }
    
    sendSimpleHTTP("AddNewHitProduct", IdProductHit);
}