<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Создание заказа</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" crossorigin="anonymous">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input required="required" id="username" type="text" name="username" class="form-control" placeholder="Username" value="<?php if (isset($requestValue["username"])): ?><?=$requestValue["username"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["username"])): ?><?=$errorMessages["username"]?><?php endif ?></strong></p>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input required="required" id="password" type="password" name="password" class="form-control" placeholder="Password" value="<?php if (isset($requestValue["password"])): ?><?=$requestValue["password"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["password"])): ?><?=$errorMessages["password"]?><?php endif ?></strong></p>
                        </div>
                        <button class="btn btn-primary">Войти</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
</html>