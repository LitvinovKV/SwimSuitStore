<?php
    session_start();
    // Если администратор не залогинен, и он пытается войти в панель администратора, 
    // то перекинуть на страницу логирования
    if (isset($_SESSION["UserLogin"]) === false) header('location:  http://' . $_SERVER['HTTP_HOST'] . '/admin/login');
    require_once "adminpanel_queries.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/cssBootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="/css/adminpanel.css"/>
    <script src="/js/adminScripts.js"></script>
    <title>Workspace</title>
</head>
<body>
    <div style="margin-top:1%; margin-left: 5%">
        <button type="submit" class="btn btn-success" onclick="changeHidden(0)">Добавить</button>
        <div>
            <!-- КНОПКИ -->
            <div style="margin-top: 0.5%; margin-left: 5%" class="ButtonBlock" hidden>
                <button type="button" class="btn btn-light" onclick="FormHidden(0, 'AddForms')">Категорию</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(1, 'AddForms')">Подкатегорию</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(2, 'AddForms')">Кружочек цвета</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(3, 'AddForms')">Размер</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(4, 'AddForms')">Продукт</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(5, 'AddForms')">Подкатегорию к продукту</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(6, 'AddForms')">Цвет к продукту</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(7, 'AddForms')">Размер к продукту</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(8, 'AddForms')">Фотографию к продукту</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(9, 'AddForms')">Баннер</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(10, 'AddForms')">Хит</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(11, 'AddForms')">Отзыв</button>

            </div>

            <!-- ФОРМЫ -->
            <div style="margin-top: 0.5%; margin-left: 10%">
                <form hidden class="AddForms">
                    <label for="example-text-input" class="col-form-label">Название категории</label>
                    <input class="form-control labelWidth" type="text" placeholder="Название категории" id="AddCategoryName">
                    <button type="button" class="btn btn-primary btnforms" onclick="addCategoryInDB()">Добавить</button>
                </form>
                
                <form hidden class="AddForms">
                    <label for="example-text-input" class="col-form-label">Название подкатегории</label>
                    <input class="form-control labelWidth" type="text" placeholder="Название подкатегории" id="AddSubcategoryName">
                    <select class="form-control SelectWidth" id="SelectAddSubcategory">
                        <option hidden>Выберите категорию</option>
                        <? 
                            for ($i = 0; $i < count($data["categories"]); $i++)
                                echo  "<option>" . $data["categories"][$i] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="addSubcategoryInDB()">Добавить</button>
                </form>
                
                <form hidden action="/adminpanel_queries.php" method="POST" enctype="multipart/form-data" class="AddForms">
                    <label for="example-text-input" class="col-form-label">Название цвета на русском</label>
                    <input class="form-control labelWidth" type="text" placeholder="Название цвета на русском" name="AddNewColorNameRu">
                    
                    <label for="example-text-input" class="col-form-label">Название цвета на английском</label>
                    <input class="form-control labelWidth" type="text" placeholder="Название цвета на английском" name="AddNewColorNameEng">

                    <label for="example-text-input" class="col-form-label">Путь к картинке с цветом в виде кружочка</label>
                    <input type="file" class="form-control-file" name="ColorPhoto" accept="image/png">

                    <button type="submit" class="btn btn-primary btnforms">Добавить</button>
                </form>
                
                <form hidden class="AddForms">
                    <label for="example-text-input" class="col-form-label">Номер размера</label>
                    <input class="form-control labelWidth" type="text" placeholder="Номер размера" id="AddNewSize">
                    <button type="button" class="btn btn-primary btnforms" onclick="addSizeInDB()">Добавить</button>
                </form>
                
                <form hidden class="AddForms">
                    <label for="example-text-input" class="col-form-label">Описание продукта на русском</label>
                    <input class="form-control labelWidth" type="text" placeholder="Описание продукта на русском" name="AddDescribeProductRU">
                    <label for="example-text-input" class="col-form-label">Описание на английском</label>
                    <input class="form-control labelWidth" type="text" placeholder="Описание на английском" name="AddDescribeProductENG">
                    <label for="example-text-input" class="col-form-label">Описание материала на русском</label>
                    <input class="form-control labelWidth" type="text" placeholder="Описание материала на русском" name="AddMaterialProductRU">
                    <label for="example-text-input" class="col-form-label">Описание материала на английском</label>
                    <input class="form-control labelWidth" type="text" placeholder="Описание материала на английском" name="AddMaterialProductENG">
                    <label for="example-text-input" class="col-form-label">Цена в рублях</label>
                    <input class="form-control labelWidth" type="text" placeholder="Цена в рублях" name="AddPriceProductRU">
                    <label for="example-text-input" class="col-form-label">Цена в долларах</label>
                    <input class="form-control labelWidth" type="text" placeholder="Цена в долларах" name="AddPriceProductENG">
                    <label for="example-text-input" class="col-form-label">Количество товара</label>
                    <input class="form-control labelWidth" type="text" placeholder="Количество товара" name="AddCountProduct">
                    <button type="button" class="btn btn-primary btnforms" onclick="AddProductInDB()">Добавить</button>
                </form>
                
                <form hidden class="AddForms">
                    <select class="form-control SelectWidth" name="AddSubcategoryName">
                        <option hidden>Выберите подкатегорию для продукта</option>
                        <? 
                            for ($i = 0; $i < count($data["subcategories"]); $i++)
                                echo  "<option>" . $data["subcategories"][$i] . "</option>";
                        ?>
                    </select>
                    <select class="form-control SelectWidth" name="AddSubcategoryProductId">
                        <option hidden>Выберите сам продукт</option>
                        <? 
                            for ($i = 0; $i < count($data["id_products"]); $i++)
                                echo  "<option>" . $data["id_products"][$i] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="AddProductAndSubcategoryInDB()">Добавить</button>
                </form>

                <form hidden class="AddForms">
                    <select class="form-control SelectWidth" name="AddColorNameForProduct">
                        <option hidden>Выберите цвет для продукта</option>
                        <? 
                            for ($i = 0; $i < count($data["colors"]); $i++)
                                echo  "<option>" . $data["colors"][$i]["id"] . "</option>";
                        ?>
                    </select>
                    <select class="form-control SelectWidth" name="AddProductIdForColor">
                        <option hidden>Выберите сам продукт</option>
                        <? 
                            for ($i = 0; $i < count($data["id_products"]); $i++)
                                echo  "<option>" . $data["id_products"][$i] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="AddColorForProduct()">Добавить</button>
                </form>
                
                <form hidden class="AddForms">
                    <select class="form-control SelectWidth" name="AddSizeNameForProduct">
                        <option hidden>Выберите размер для продукта</option>
                        <? 
                            for ($i = 0; $i < count($data["sizes"]); $i++)
                                echo  "<option>" . $data["sizes"][$i] . "</option>";
                        ?>
                    </select>
                    <select class="form-control SelectWidth" name="AddProductIdForSize">
                        <option hidden>Выберите сам продукт</option>
                        <? 
                            for ($i = 0; $i < count($data["id_products"]); $i++)
                                echo  "<option>" . $data["id_products"][$i] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="AddSizeForProduct()">Добавить</button>
                </form>
                
                <form hidden action="/adminpanel_queries.php" method="POST" enctype="multipart/form-data" class="AddForms">
                    <label for="exampleFormControlFile1">Выберите фотографию для продукта (jpg формат)</label>
                    <input type="file" class="form-control-file" name="ProductPhoto" accept="image/jpg">
                    <select class="form-control SelectWidth" name="ProductId">
                        <option hidden>Выберите сам продукт</option>
                        <? 
                            for ($i = 0; $i < count($data["id_products"]); $i++)
                                echo  "<option>" . $data["id_products"][$i] . "</option>";
                        ?>
                    </select>
                    <button type="submit" class="btn btn-primary btnforms">Добавить</button>
                </form>
                
                <form hidden  action="/adminpanel_queries.php" class="AddForms" method="POST" enctype="multipart/form-data">
                    <label for="exampleFormControlFile1">Выберите фотографию для баннера (png формат)</label>
                    <input type="file" class="form-control-file" name="BannerPhoto" accept="image/png">
                    <button type="submit" class="btn btn-primary btnforms">Добавить</button>
                </form>

                <form hidden class="AddForms">
                <?
                    $forms = <<<HEADFORM
                    <select class="form-control SelectWidth" name="AddProductHit">
                        <option hidden>Выберите идентификатор продукта</option>
HEADFORM;
                         
                    for ($i = 0; $i < count($data["id_products"]); $i++)
                        $forms .=  "<option>" . $data["id_products"][$i] . "</option>";
                        
                    $forms .= <<<BOTTOMFORM
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="AddNewProductHit()">Сделать хитом</button>
BOTTOMFORM;
                if ($data["hits"][0] < 3)
                    echo $forms;
                else
                    echo "ТОВАРОВ, ЯВЛЯЮЩИМИСЯ ХИТОМ РОВНО 3! УДАЛИТЕ ТОВАР, ЧТОБЫ ДОБАВИТЬ НОВЫЙ ХИТ!";
                ?>
                </form>

                <form hidden class="AddForms">
                    <label for="example-text-input" class="col-form-label">Ссылка через просмотр кода и тег img(6 + по идее)</label>
                    <input class="form-control labelWidth" type="text" placeholder="Ссылка через просмотр кода и тег img(6 + по идее)" name="AddHrefDisk">
                    <label for="example-text-input" class="col-form-label">Ссылка на инстаграмм</label>
                    <input class="form-control labelWidth" type="text" placeholder="Ссылка на инстаграмм" name="AddHrefInst">
                    <button type="button" class="btn btn-primary btnforms" onclick="AddReviews()">Добавить</button>
                </form>
            </div>
        </div>
    </div>
    
    <div style="margin-top:1%; margin-left: 5%">
        <button type="submit" class="btn btn-info" onclick="changeHidden(1)" >Редактировать</button>
        <div>
            <!-- КНОПКИ -->
            <div style="margin-top: 0.5%; margin-left: 5%" class="ButtonBlock" hidden>
                <button type="button" class="btn btn-light" onclick="FormHidden(0, 'UpdateForms')">Категорию</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(1, 'UpdateForms')">Подкатегорию</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(2, 'UpdateForms')">Цвет</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(3, 'UpdateForms')">Размер</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(4, 'UpdateForms')">Продукт</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(5, 'UpdateForms')">Убрать хит</button>
            </div>

            <!-- ФОРМА -->
            <div style="margin-top: 0.5%; margin-left: 10%">
                
                <form hidden class="UpdateForms">
                    <select class="form-control SelectWidth" onchange="changeJS(this.value, ChangedCategoryName)" name="OldestCategoryName">
                        <option hidden>Выберите категорию</option>
                        <? 
                            for ($i = 0; $i < count($data["categories"]); $i++)
                                echo  "<option>" . $data["categories"][$i] . "</option>";
                        ?>
                    </select>
                    <label for="example-text-input" class="col-form-label">Редактировать название категории</label>
                    <input class="form-control labelWidth" type="text" name="ChangedCategoryName">
                    <button type="button" class="btn btn-primary btnforms" onclick="RedactCategoryName()">Редактировать</button>
                </form>
                
                <form hidden class="UpdateForms">
                    <select class="form-control SelectWidth" onchange="changeJS(this.value, ChangedSubcategoryName)" name="OldestSubcategoryName">
                        <option hidden>Выберите подкатегорию</option>
                        <? 
                            for ($i = 0; $i < count($data["subcategories"]); $i++)
                                echo  "<option>" . $data["subcategories"][$i] . "</option>";
                        ?>
                    </select>
                    <label for="example-text-input" class="col-form-label">Редактировать название подкатегории</label>
                    <input class="form-control labelWidth" type="text" name="ChangedSubcategoryName">
                    <button type="button" class="btn btn-primary btnforms" onclick="RedactSubcategoryName()">Редактировать</button>
                </form>
                
                <form hidden action="/adminpanel_queries.php" method="POST" enctype="multipart/form-data" class="UpdateForms">
                    <select class="form-control SelectWidth" onchange="changeJS(this.value, ChangedColorName)" name="ShowColorById">
                        <option hidden>Выберите цвет</option>
                        <? 
                            for ($i = 0; $i < count($data["colors"]); $i++)
                                echo  "<option>" . $data["colors"][$i]["id"] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="ShowColorInformation()">Отобразить данные</button><br>
                    
                    <label for="example-text-input" class="col-form-label">Название цвета на русском</label>
                    <input class="form-control labelWidth" type="text" placeholder="Название цвета на русском" name="ShowColorNameRu">
                    
                    <label for="example-text-input" class="col-form-label">Название цвета на английском</label>
                    <input class="form-control labelWidth" type="text" placeholder="Название цвета на английском" name="ShowColorNameEng">
                    
                    <label for="example-text-input" class="col-form-label">Фотография</label>
                    <img src="" name="ShowColorPhoto"><br>
                    
                    <label for="example-text-input" class="col-form-label">Путь к картинке с цветом в виде кружочка</label>
                    <input type="file" class="form-control-file" name="RedactColorPhoto" accept="image/png">

                    <button type="submit" class="btn btn-primary btnforms">Редактировать данные</button><br>
                </form>
                
                <form hidden class="UpdateForms">
                    <select class="form-control SelectWidth" onchange="changeJS(this.value, ChangedSizeName)" name="OldSizeName">
                        <option hidden>Выберите размер</option>
                        <? 
                            for ($i = 0; $i < count($data["sizes"]); $i++)
                                echo  "<option>" . $data["sizes"][$i] . "</option>";
                        ?>
                    </select>
                    <label for="example-text-input" class="col-form-label">Редактировать название цвета</label>
                    <input class="form-control labelWidth" type="text" name="ChangedSizeName">
                    <button type="button" class="btn btn-primary btnforms" onclick="RedactSizeName()">Редактировать</button>
                </form>
                
                <form hidden class="UpdateForms">
                    <select class="form-control SelectWidth" onchange="selectProduct(this.value)" name="ChangedIdProduct">
                        <option hidden>Выберите идентфиикатор продукта</option>
                        <? 
                            for ($i = 0; $i < count($data["id_products"]); $i++)
                                echo  "<option>" . $data["id_products"][$i] . "</option>";
                        ?>
                    </select>
                    <label for="example-text-input" class="col-form-label">Редактировать описание на русском </label>
                    <input class="form-control labelWidth" type="text" name="ChangedDescProductRU">

                    <label for="example-text-input" class="col-form-label">Редактировать описание на английском</label>
                    <input class="form-control labelWidth" type="text" name="ChangedDescProductENG">

                    <label for="example-text-input" class="col-form-label">Редактировать описание материала на русском</label>
                    <input class="form-control labelWidth" type="text" name="ChangedDescMaterialProductRU">

                    <label for="example-text-input" class="col-form-label">Редактировать описание материала на английском</label>
                    <input class="form-control labelWidth" type="text" name="ChangedDescMaterialProductENG">

                    <label for="example-text-input" class="col-form-label">Редактировать цену на русском</label>
                    <input class="form-control labelWidth" type="text" name="ChangedPriceProductRU">
                    
                    <label for="example-text-input" class="col-form-label">Редактировать цену на английском</label>
                    <input class="form-control labelWidth" type="text" name="ChangedPriceProductENG">

                    <label for="example-text-input" class="col-form-label">Редактировать кол-во товара</label>
                    <input class="form-control labelWidth" type="text" name="ChangedQuanityProduct">
                    
                    <button type="button" class="btn btn-primary btnforms" onclick="RedactInformationAboutlProduct()">Редактировать</button>
                </form>
            
            <form hidden class="UpdateForms">
                <select class="form-control SelectWidth" onchange="selectProduct(this.value)" name="HitProductRedact">
                    <option hidden>Выберите идентфиикатор продукта</option>
                       <?
                           for ($i = 0; $i < count($data["products"]); $i++) {
                                if ($data["products"][$i]["Hit"] === "1")
                                    echo  "<option>" . $data["products"][$i]["id"] . "</option>";
                           }
                        ?>
                </select>
                <button type="button" class="btn btn-primary btnforms" onclick="DeleteHit()">Убрать хит</button>
            </form>
            
            </div>
        </div>
    </div>
    
    <div style="margin-top:1%; margin-left: 5%">
        <button type="submit" class="btn btn-warning" onclick="changeHidden(2)">Удалить</button>
        <div>
            <!-- КНОПКИ -->
            <div style="margin-top: 0.5%; margin-left: 5%" class="ButtonBlock" hidden>
                <!-- <button type="button" class="btn btn-light" onclick="FormHidden(0, 'DeleteForms')">Категорию</button> -->
                <!-- <button type="button" class="btn btn-light" onclick="FormHidden(0, 'DeleteForms')">Подкатегорию</button> -->
                <button type="button" class="btn btn-light" onclick="FormHidden(0, 'DeleteForms')">Цвет</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(1, 'DeleteForms')">Размер</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(2, 'DeleteForms')">Цвет у продукта</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(3, 'DeleteForms')">Размер у продукта</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(4, 'DeleteForms')">Продукт</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(5, 'DeleteForms')">Фотографию продукта</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(6, 'DeleteForms')">Отзыв</button>
            </div>

            <!-- ФОРМА -->
            <div style="margin-top: 0.5%; margin-left: 10%">
                <!-- <form hidden class="DeleteForms">
                <select class="form-control SelectWidth" name="DeleteCategoryName">
                        <option hidden>Выберите категорию</option>
                        <? 
                            // for ($i = 0; $i < count($data["categories"]); $i++)
                            //     echo  "<option>" . $data["categories"][$i] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="DeleteCategoryByName()">Удалить</button>
                </form> -->

                <!-- <form hidden class="DeleteForms">
                    Удалить подкатегорию
                </form> -->

                <form hidden class="DeleteForms">
                    <select class="form-control SelectWidth" name="DeleteColor">
                        <option hidden>Выберите цвет</option>
                        <? 
                            for ($i = 0; $i < count($data["colors"]); $i++)
                                echo  "<option>" . $data["colors"][$i]["id"] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="DeleteCurrentColor()">Удалить</button>
                </form>

                <form hidden class="DeleteForms">
                    <select class="form-control SelectWidth" name="DeleteSize">
                        <option hidden>Выберите размер</option>
                        <? 
                            for ($i = 0; $i < count($data["sizes"]); $i++)
                                echo  "<option>" . $data["sizes"][$i] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="DeleteCurrentSize()">Удалить</button>
                </form>

                <form hidden class="DeleteForms">
                    <select class="form-control SelectWidth" name="DeletePC_Color">
                        <option hidden>Выберите цвет</option>
                        <? 
                            for ($i = 0; $i < count($data["colors"]); $i++)
                                echo  "<option>" . $data["colors"][$i]["id"] . "</option>";
                        ?>
                    </select>
                    <select class="form-control SelectWidth" name="DeletePC_Product">
                        <option hidden>Выберите идентификатор продукта</option>
                        <? 
                            for ($i = 0; $i < count($data["id_products"]); $i++)
                                echo  "<option>" . $data["id_products"][$i] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="DeleteProductColor()">Удалить</button>
                </form>

                <form hidden class="DeleteForms">
                    <select class="form-control SelectWidth" name="DeletePS_Size">
                        <option hidden>Выберите размер</option>
                        <? 
                            for ($i = 0; $i < count($data["sizes"]); $i++)
                                echo  "<option>" . $data["sizes"][$i] . "</option>";
                        ?>
                    </select>
                    <select class="form-control SelectWidth" name="DeletePS_Product">
                        <option hidden>Выберите идентификатор продукта</option>
                        <? 
                            for ($i = 0; $i < count($data["id_products"]); $i++)
                                echo  "<option>" . $data["id_products"][$i] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="DeleteProductSize()">Удалить</button>
                </form>

                <form hidden class="DeleteForms">
                    <select class="form-control SelectWidth" name="DeleteProduct">
                        <option hidden>Выберите идентификатор продукта</option>
                        <? 
                            for ($i = 0; $i < count($data["id_products"]); $i++)
                                echo  "<option>" . $data["id_products"][$i] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="DeleteCurrentProduct()">Удалить</button>
                </form>

                <form hidden class="DeleteForms">
                    <select class="form-control SelectWidth" name="ShowProductsPhotoId">
                        <option hidden>Выберите идентификатор продукта</option>
                        <? 
                            for ($i = 0; $i < count($data["id_products"]); $i++)
                                echo  "<option>" . $data["id_products"][$i] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="ShowPhotosForProduct()">Отобразить фотографии</button>
                    <div id="ShowPicturesProduct">
                        
                    </div>
                    <button type="button" class="btn btn-primary btnforms" onclick="DeleteProductPictures()">Удалить</button>
                </form>

                <form hidden class="DeleteForms">
                    <?
                        for ($i = 0; $i < count($data["reviews"]); $i++) {
                            echo "<input type=\"checkbox\" name=\"photoReviews\" value=\"" . $data['reviews'][$i]["id"] . "\"/>" . 
                                "<img src=" . $data['reviews'][$i]["href"] . " width=\"189\" height=\"255\">" . "<br>";
                        }
                    ?>
                    <button type="button" class="btn btn-primary btnforms" onclick="DeleteReviews()">Удалить</button>
                </form>
    
            </div>
        </div>
    </div>

    <div style="margin-top:1%; margin-left: 5%">
        <button type="submit" class="btn btn-primary" onclick="changeHidden(3)">Заказы</button>
        <div>
            <!-- КНОПКИ -->
            <div style="margin-top: 0.5%; margin-left: 5%" class="ButtonBlock" hidden>
                <button type="button" class="btn btn-light" onclick="FormHidden(0, 'Orders')">Просмотреть</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(1, 'Orders')">Редактировать</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(2, 'Orders')">Удалить</button>
            </div>

            <!-- ФОРМА -->
            <div style="margin-top: 0.5%; margin-left: 10%">
                <form hidden class="Orders">
                    <?
                        for($i = 0; $i < count($data["orders"]); $i++) {
                            echo "<span class=\"ParametrProductName\">Заказ №" . $data["orders"][$i]["id_order"] . "</span><br>";
                            echo "<span class=\"ParametrProductName\">ФИО Клиента : </span>" . $data["orders"][$i]["full_name"] . "<br>";
                            echo "<span class=\"ParametrProductName\">Адрес Клиента : </span>" . $data["orders"][$i]["adress"] . "<br>";
                            echo "<span class=\"ParametrProductName\">Номер телефона Клиента : </span>" . $data["orders"][$i]["phone_number"] . "<br>";
                            echo "<span class=\"ParametrProductName\">Почтовый индекс Клиента : </span>" . $data["orders"][$i]["post_index"] . "<br>";
                            echo "<span class=\"ParametrProductName\">Описание покупки : </span>" . "<br>";
                            echo $data["orders"][$i]["description"];
                            echo "<hr>";
                        }
                    ?>    
                </form>
                
                <form hidden class="Orders">
                    <select class="form-control SelectWidth" name="RedactOrdersId">
                        <option hidden>Выберите идентификатор заказа</option>
                        <? 
                            for ($i = 0; $i < count($data["orders"]); $i++)
                                echo  "<option>" . $data["orders"][$i]["id_order"] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="ShowRedactParametrs()">Отобразить данные</button><br>
                    
                    <label for="example-text-input" class="col-form-label">Редактировать ФИО Клиента</label>
                    <input class="form-control labelWidth" type="text" name="ChangedFIOClient">
                    <label for="example-text-input" class="col-form-label">Редактировать Адрес Клиента</label>
                    <input class="form-control labelWidth" type="text" name="ChangedAdressClient">
                    <label for="example-text-input" class="col-form-label">Редактировать Номер телефона Клиента</label>
                    <input class="form-control labelWidth" type="text" name="ChangedPhoneNumberClient">
                    <label for="example-text-input" class="col-form-label">Редактировать Почтовый индекс Клиента</label>
                    <input class="form-control labelWidth" type="text" name="ChangedPostIndexClient">
                    <label for="example-text-input" class="col-form-label">Редактировать Описание покупки</label>
                    <input class="form-control labelWidth" type="text" name="ChangedDescriptionOrderClient">
                    <button type="button" class="btn btn-primary btnforms" onclick="RedactOrderParametrs()">Редактировать</button>
                </form>
                
                <form hidden class="Orders">
                    <select class="form-control SelectWidth" name="DeleteOrdersId">
                        <option hidden>Выберите идентификатор заказа</option>
                        <? 
                            for ($i = 0; $i < count($data["orders"]); $i++)
                                echo  "<option>" . $data["orders"][$i]["id_order"] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="DeleteCurrentOrder()">Удалить</button><br>
                    
                </form>
            </div>
        </div>
    </div>

    <div style="margin-top:1%; margin-left: 5%">
        <button type="submit" class="btn btn-primary" onclick="changeHidden(4)">Отобразить информацию о продуктах</button>
        <div style="margin-top: 0.5%; margin-left: 5%" class="ButtonBlock" hidden>
            <?
                for($i = 0; $i < count($data["products"]); $i++) {
                    echo "<span class=\"ParametrProductName\">Идентификатор продукта : </span>" . $data["products"][$i]["id"] . "<br>";
                    echo "<span class=\"ParametrProductName\">Фотографии : </span>" . "<br>";
                    for ($j = 0; $j < count($data["products"][$i]["photos"]); $j++) {
                        echo ($j + 1) . ". Название фотографии : " . $data["products"][$i]["photos"][$j] . "<br>";
                        echo "<img src=\"/images/products_images/" . $data["products"][$i]["photos"][$j] . "\" width=\"189\" height=\"255\">" . "<br>";
                    }
                    echo "<span class=\"ParametrProductName\">Подкатегории : </span>" . "<br>";
                    for ($j = 0; $j < count($data["products"][$i]["subcategories"]); $j++)
                        echo ($j + 1) . ". Название подкатегории : " . $data["products"][$i]["subcategories"][$j] . "<br>";
                    echo "<span class=\"ParametrProductName\">Цвета : </span>" . "<br>";
                    for ($j = 0; $j < count($data["products"][$i]["Colors"]); $j++)
                        echo ($j + 1) . ". Название цвета : " . $data["products"][$i]["Colors"][$j] . "<br>";
                    echo "<span class=\"ParametrProductName\">Размеры : </span>" . "<br>";
                    for ($j = 0; $j < count($data["products"][$i]["Sizes"]); $j++)
                        echo ($j + 1) . ". Название размера : " . $data["products"][$i]["Sizes"][$j] . "<br>";
                    echo "<span class=\"ParametrProductName\">Хит : </span>" . (($data["products"][$i]["Hit"]) ? "Да" : "Нет") . "<br>";
                    echo "<hr>";
                }
            ?>
        </div>
    </div>

    <form method="post">
        <button type="submit" class="btn btn-danger" name="ExitAdminPanel" id="ExitButton">Выход</button>
    </form>
    
    <label for="exampleFormControlFile1">
            РУКОВОДСТВО: <br>
            1. При добавлении, редактированиии, удалении файлов на сервере (изображений) после нажатия КНОПКИ
            перекидывает снова на страницу панели администратора, то все ОК. Иначе выдало бы ошибку.<br>Также возможна проблема с 
            добавлением новых фотографий в БД. Проблема возникает из-за большое размера изображения...<br>
            2. Название БАННЕРА должно обязательно со слова "banner_" <br>
            3. Название НИЖНЕГО БАННЕРА должно обязательно со слова "bottom_"<br>
            4. Ожидаемый размер баннера: <br>
            5. Ожидаемый размер нижнего баннера: <br>
            6. Ожидаемый размер фотографий : <br>
            7. Кол-во фотографий у одного продукта должно быть >= 3 <br>
            8. Кружочек для цвета должен быть размером ...  и формата только png<br>
            9. Фотографий у продукта не должно быть > 5 (<= 4 РЕКОМЕНДОВАННО!) <br>
            </label>
</body>
</html>