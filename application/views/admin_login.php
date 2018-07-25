<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" >
	<link rel="stylesheet" type="text/css" href="/css/cssBootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="/css/adminpanel.css"/>
	<script src="/js/anotherScripts.js"></script>
</head>
<body>
    
    <?
        session_start();
        // Если уже запущена сессия с параметром UserLogin, то покинуть страницу логирования
        // и перейти в рабочее пространство
        if (isset($_SESSION['UserLogin']) === true) header('location:  http://' . $_SERVER['HTTP_HOST'] . 
            '/admin/workspace');

        // Скрипты для запросов панели администратора
        require_once "adminpanel_queries.php";

        // var_dump(md5("KetiKate081195"));
		// var_dump(md5("ReWqASdf951108"));
    ?>

    <form method="POST">
        <div id="blockForm">
            <div class="form-group">
                <label for="exampleInputEmail1">User name</label>
                <input class="form-control"  placeholder="Enter user name" name="UserLog">
                <small id="emailHelp" class="form-text text-muted">Hello BUDDY! You must enter correct data...</small>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter password" name="UserPass">
            </div>
    
            <button type="submit" class="btn btn-primary" name="LogIn">Log In</button>
        </div>
    </form>

</body>
</html>