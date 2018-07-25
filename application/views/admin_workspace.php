<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/cssBootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="/css/adminpanel.css"/>
    <title>Workspace</title>
</head>
<body>
    
    <?php 
        session_start();
        // Если администратор не залогинен, и он пытается войти в панель администратора, 
        // то перекинуть на страницу логирования
        if (isset($_SESSION["UserLogin"]) === false) header('location:  http://' . $_SERVER['HTTP_HOST'] . '/admin/login');
        require_once "adminpanel_queries.php";
    ?>

    <h1>HI!</h1>
    <form method="post">
        <button type="submit" class="btn btn-danger btn-lg" name="ExitList">Exit</button>
    </form>
</body>
</html>