<?php
    session_start();
    // Если администратор не залогинен, и он пытается войти в панель администратора, 
    // то перекинуть на страницу логирования
    if (isset($_SESSION["UserLogin"]) === false) header('location:  http://' . $_SERVER['HTTP_HOST'] . '/admin/login');
    require_once "adminpanel_queries.php";
    // var_dump($data);
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
                <button type="button" class="btn btn-light" onclick="FormHidden(2, 'AddForms')">Цвет</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(3, 'AddForms')">Размер</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(4, 'AddForms')">Продукт</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(5, 'AddForms')">Подкатегорию к продукту</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(6, 'AddForms')">Цвет к продукту</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(7, 'AddForms')">Размер к продукту</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(8, 'AddForms')">Фотографию к продукту</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(9, 'AddForms')">Баннер</button>
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
                            for ($i = 0; $i < count($data["colors"]); $i++)
                                echo  "<option>" . $data["categories"][$i] . "</option>";
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btnforms" onclick="addSubcategoryInDB()">Добавить</button>
                </form>
                
                <form hidden class="AddForms">
                    <label for="example-text-input" class="col-form-label">Название цвета</label>
                    <input class="form-control labelWidth" type="text" placeholder="Название цвета" id="AddNewColor">
                    <button type="button" class="btn btn-primary btnforms" onclick="addColorInDB()">Добавить</button>
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
                                echo  "<option>" . $data["colors"][$i] . "</option>";
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
                <button type="button" class="btn btn-light" onclick="FormHidden(5, 'UpdateForms')">Фотографию</button>
            </div>

            <!-- ФОРМА -->
            <div>
                <form hidden class="UpdateForms">
                    Редактировать категорию
                </form>
                <form hidden class="UpdateForms">
                    Редактировать подкатегорию
                </form>
                <form hidden class="UpdateForms">
                    Редактировать цвет
                </form>
                <form hidden class="UpdateForms">
                    Редактировать размер
                </form>
                <form hidden class="UpdateForms">
                    Редактировать продукт
                </form>
                <form hidden class="UpdateForms">
                    Редактировать фотографию
                </form>
            </div>
        </div>
    </div>
    
    <div style="margin-top:1%; margin-left: 5%">
        <button type="submit" class="btn btn-warning" onclick="changeHidden(2)">Удалить</button>
        <div>
            <!-- КНОПКИ -->
            <div style="margin-top: 0.5%; margin-left: 5%" class="ButtonBlock" hidden>
                <button type="button" class="btn btn-light" onclick="FormHidden(0, 'DeleteForms')">Категорию</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(1, 'DeleteForms')">Подкатегорию</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(2, 'DeleteForms')">Цвет</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(3, 'DeleteForms')">Размер</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(4, 'DeleteForms')">Продукт</button>
                <button type="button" class="btn btn-light" onclick="FormHidden(5, 'DeleteForms')">Фотографию</button>
            </div>

            <!-- ФОРМА -->
            <div>
                <form hidden class="DeleteForms">
                    Удалить категорию
                </form>
                <form hidden class="DeleteForms">
                    Удалить подкатегорию
                </form>
                <form hidden class="DeleteForms">
                    Удалить цвет
                </form>
                <form hidden class="DeleteForms">
                    Удалить размер
                </form>
                <form hidden class="DeleteForms">
                    Удалить продукт
                </form>
                <form hidden class="DeleteForms">
                    Удалить фотографию
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
            <div>
                <form hidden class="Orders">
                    Отобразить заказы
                </form>
                <form hidden class="Orders">
                    Редактировать заказы
                </form>
                <form hidden class="Orders">
                    Удалить заказ
                </form>
            </div>
        </div>
    </div>

    <form method="post">
        <button type="submit" class="btn btn-danger" name="ExitAdminPanel" id="ExitButton">Выход</button>
    </form>
    
    <label for="exampleFormControlFile1">При добавлении, редактированиии, удалении файлов на сервере (изображений) после нажатия КНОПКИ
            перекидывает снова на страницу панели администратора, то все ОК. Иначе выдало бы ошибку.<br>Также возможна проблема с 
            добавлением новых фотографий в БД. Проблема возникает из-за большое размера изображения...</label>
</body>
</html>