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

function ShowColorInformation(idColor = document.getElementsByName("ShowColorById")[0].value) {
    
    if(idColor.length === 0) {
        alert("Вы не заполнили форму!");
    }

    let XHR = new XMLHttpRequest();
    // Настроить POST запрос
    XHR.open("POST", "/adminpanel_queries.php", true);
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Отправить запрос
    let body = "IdColorForReturnInformation=" + idColor;
    XHR.send(body);
    // Если запрос имеет статус 200 (успешно обработан)
    XHR.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Разбить строку, которая пришла в качестве ответа на массив строк
            let answer = this.responseText.split("//");
            let colorPath = "/images/s_networks/" + answer[3];
            document.getElementsByName("ShowColorNameRu")[0].value = answer[1];
            document.getElementsByName("ShowColorNameEng")[0].value = answer[2];
            document.getElementsByName("ShowColorPhoto")[0].src = colorPath;
        }
    }
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

// Ф-ия которая отправялет запрос на удаление выбранной категории
function DeleteCategoryByName(CategoryName = document.getElementsByName("DeleteCategoryName")[0].value) {
    if (CategoryName.length === 0) {
        alert("Вы не заполнили форму!");
        return;
    }

    sendSimpleHTTP("DeleteCategoryName", CategoryName);
}

// Ф-ия кторая отправляет запрос на удаление выбранного цвета
function DeleteCurrentColor(ColorName = document.getElementsByName("DeleteColor")[0].value) {
    if (ColorName.length === 0) {
        alert("Вы не заполнили форму!");
        return;
    }

    sendSimpleHTTP("DeleteColorName", ColorName);
}

// Ф-ия которая отправляет запрос на удаление выбранного размера
function DeleteCurrentSize(SizeName = document.getElementsByName("DeleteSize")[0].value) {
    if (SizeName.length === 0) {
        alert("Вы не заполнили форму!");
        return;
    }

    sendSimpleHTTP("DeleteSizeName", SizeName);
}

// Ф-ия которая отправялет запрос на удаленние выбранного цвета у определенного товара
function DeleteProductColor(ColorName = document.getElementsByName("DeletePC_Color")[0].value,
    ProductId = document.getElementsByName("DeletePC_Product")[0].value) {
    
    if (ColorName.length === 0 || ProductId.length === 0) {
        alert("Вы не заполнили форму!");
        return;
    }

    sendSimpleDoubleHTTP("DeletePC_ColorName", ColorName, "DeletePC_ProductId", ProductId);
}

// Ф-ия которая отправляет запрос на удаление выбранного размера у выбранного товара
function DeleteProductSize(SizeName = document.getElementsByName("DeletePS_Size")[0].value,
    ProductId = document.getElementsByName("DeletePS_Product")[0].value) {

    if (SizeName.length === 0 || ProductId.length === 0) {
        alert("Вы не заполнили форму!");
        return;
    }

    sendSimpleDoubleHTTP("DeletePS_SizeName", SizeName, "DeletePS_ProductId", ProductId);
}

// Ф-ия которая отправляет запрос на удаление выбранного продукта
function DeleteCurrentProduct(ProductId = document.getElementsByName("DeleteProduct")[0].value) {
    if (ProductId.length === 0) {
        alert("Вы не заполнили форму!");
        return;
    }

    sendSimpleHTTP("DeleteCurrentProductId", ProductId);
}

// Ф-ия которая отправляет запрос на получение и отображение фотографий продукта на странице
function ShowPhotosForProduct(ProductId = document.getElementsByName("ShowProductsPhotoId")[0].value) {
    if (ProductId.length === 0) {
        alert("Вы не заполнили форму!");
        return;   
    }

    let XHR = new XMLHttpRequest();
    // Настроить POST запрос
    XHR.open("POST", "/adminpanel_queries.php", true);
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Отправить запрос
    let body = "ProductPhotosById=" + ProductId;
    XHR.send(body);
    // Если запрос имеет статус 200 (успешно обработан)
    XHR.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Разбить строку, которая пришла в качестве ответа на массив строк
            let answer = this.responseText.split("//");
            let parent = document.getElementById("ShowPicturesProduct");
            parent.innerHTML = '';
            for(let i = 0; i < answer.length; i++) {
                let div = document.createElement("div");
                let inputDiv = "<input type=\"checkbox\" name=\"photoProduct\" value=\"" + answer[i] + "\"/>" +
                    "<img src=\"/images/products_images/" + answer[i] + "\" >";
                div.innerHTML = inputDiv;
                parent.appendChild(div);
            }
        }
    };
}

// Ф-ия которая отправляет запрос на удаление фотографий выбранного продукта
function DeleteProductPictures(elements = document.getElementsByName("photoProduct")) {
    let request = "";
    let checkedElements = [];
    
    // Получить только те элементы, который были выбраны администратором (помечены флажком)
    for(i = 0; i < elements.length; i++) {
        if (elements[i].checked === true) {
            checkedElements[checkedElements.length] = elements[i].value;
        }
    }

    if (checkedElements.length === 0) {
        alert("Вы не выбрали ни одной фотографии!");
        return;
    }

    sendSimpleHTTP("DeleteProductPictures", checkedElements);
}

// Ф-ия которая отправляет запрос на выборку информации по определеному заказу
function ShowRedactParametrs(OrderId = document.getElementsByName("RedactOrdersId")[0].value) {
    if (OrderId.length === 0) {
        alert("Вы не выбрали заказ!");
        return;
    }

    let XHR = new XMLHttpRequest();
    // Настроить POST запрос
    XHR.open("POST", "/adminpanel_queries.php", true);
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Отправить запрос
    let body = "GetOrderParametrs=" + OrderId;
    XHR.send(body);
    // Если запрос имеет статус 200 (успешно обработан)
    XHR.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let result = this.responseText.split("//");
            document.getElementsByName("ChangedFIOClient")[0].value = result[1];
            document.getElementsByName("ChangedAdressClient")[0].value = result[2];
            document.getElementsByName("ChangedPhoneNumberClient")[0].value = result[3];
            document.getElementsByName("ChangedPostIndexClient")[0].value = result[4];
            document.getElementsByName("ChangedDescriptionOrderClient")[0].value = result[5];
        }
    }
}

// Ф-ия которая отправляет запрос на сервер для редактирования выбранного заказа
function RedactOrderParametrs(OrderId = document.getElementsByName("RedactOrdersId")[0].value,
    FIO_Order = document.getElementsByName("ChangedFIOClient")[0].value,
    Adress_Order = document.getElementsByName("ChangedAdressClient")[0].value,
    PhoneNumber_Order = document.getElementsByName("ChangedPhoneNumberClient")[0].value,
    PostIndex_Order = document.getElementsByName("ChangedPostIndexClient")[0].value,
    Description_Order = document.getElementsByName("ChangedDescriptionOrderClient")[0].value) {

    if (OrderId.length === 0 || FIO_Order.length === 0 || Adress_Order.length === 0 || 
    PhoneNumber_Order.length === 0 || PostIndex_Order.length === 0 || Description_Order.lengt === 0) {
        alert("Вы не ввели параемтры в форму.");
        return;    
    }

    let XHR = new XMLHttpRequest();
    // Настроить POST запрос
    XHR.open("POST", "/adminpanel_queries.php", true);
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Отправить запрос
    let body = "ChangeOrderId=" + OrderId + "&ChangeOrderFIO=" + FIO_Order + "&ChangeOrderAdress=" +
        Adress_Order + "&ChangePhoneNumberOrder=" + PhoneNumber_Order + "&ChangePostIndexOrder=" + 
        PostIndex_Order + "&ChangeDescriptionOrder=" + Description_Order;
    XHR.send(body);
    // Если запрос имеет статус 200 (успешно обработан)
    XHR.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    }
}

// Ф-ия которая отправляет запрос на удаление выбранного заказа
function DeleteCurrentOrder(OrderId = document.getElementsByName("DeleteOrdersId")[0].value) {
    if (OrderId.length === 0) {
        alert("Вы не выбрали заказ.");
        return;
    }

    sendSimpleHTTP("DeleteCurrentOrder", OrderId);
}

// Ф-ия которая удаляет знамение ХИТ у товара
function DeleteHit(ProductId = document.getElementsByName("HitProductRedact")[0].value) {
    if (ProductId.length === 0) {
        alert("Вы не выбрали продукт.");
        return;
    }

    sendSimpleHTTP("DeleteHitProduct", ProductId);
}

// Добавление отзыва
function AddReviews(HrefDisk = document.getElementsByName("AddHrefDisk")[0].value, 
    HrefInst = document.getElementsByName("AddHrefInst")[0].value) {
        if(HrefDisk.length === 0 || HrefInst.length === 0) {
            alert("Вы не ввели данные");
            return;
        }
        
        sendSimpleDoubleHTTP("AddHrefDisk", HrefDisk, "AddHrefInst", HrefInst);
}

function DeleteReviews(elements = document.getElementsByName("photoReviews")) {
    let checkedElements = [];
    
    // Получить только те элементы, который были выбраны администратором (помечены флажком)
    let k = 0;
    for(i = 0; i < elements.length; i++) {
        if (elements[i].checked === true) {
            checkedElements[k] = elements[i].value;
            k++;
        }
    }

    if (checkedElements.length === 0) {
        alert("Вы не выбрали ни одной фотографии!");
        return;
    }

    sendSimpleHTTP("DeleteReviews", checkedElements);
}