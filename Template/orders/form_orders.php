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
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="row">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="/">Список заказов</a></li>
                            <li class="active"><a href="/order/create">Добавить заказ</a></li>
                            <li><a href="#">Склад</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Добавить заказ</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="post">
                        <div class="form-group">
                            <label for="create_order_order_number">Номер заказа в битрексе</label>
                            <input required="required" id="create_order_order_number" type="number" name="create_order[order_number]" class="form-control" placeholder="Номер заказа в битрексе" value="<?php if (isset($requestValue["order_number"])): ?><?=$requestValue["order_number"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["orderNumber"])): ?><?=$errorMessages["orderNumber"]?><?php endif ?></strong></p>
                        </div>
                        <div class="form-group">
                            <label for="create_order_price">Цена</label>
                            <input required="required" id="create_order_price" type="text" name="create_order[price]" class="form-control" placeholder="Цена" value="<?php if (isset($requestValue["price"])): ?><?=$requestValue["price"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["price"])): ?><?=$errorMessages["price"]?><?php endif ?></strong></p>
                        </div>
                        <div class="form-group">
                            <label for="create_order_count_product">Количество продуктов в заказе</label>
                            <input required="required" id="create_order_count_product" type="number" name="create_order[count_product]" class="form-control" placeholder="Количество продуктов в заказе" value="<?php if (isset($requestValue["count_product"])): ?><?=$requestValue["count_product"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["countProduct"])): ?><?=$errorMessages["countProduct"]?><?php endif ?></strong></p>
                        </div>
                        <div class="form-group">
                            <label for="create_order_order_username">Имя заказчика</label>
                            <input required="required" id="create_order_order_username" type="text" name="create_order[order_username]" class="form-control" placeholder="Имя заказчика" value="<?php if (isset($requestValue["order_username"])): ?><?=$requestValue["order_username"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["orderUsername"])): ?><?=$errorMessages["orderUsername"]?><?php endif ?></strong></p>
                        </div>
                        <div class="form-group">
                            <label for="create_order_order_information">Информация о заказе</label>
                            <textarea required="required" id="create_order_order_information" class="form-control" name="create_order[order_information]" placeholder="Информация о заказе" rows="10"><?php if (isset($requestValue["order_information"])): ?><?=$requestValue["order_information"]?><?php endif ?></textarea>
                            <p class="text-danger"><strong><?php if (isset($errorMessages["orderInformation"])): ?><?=$errorMessages["orderInformation"]?><?php endif ?></strong></p>
                        </div>
                        <button class="btn btn-primary">Добавить</button>
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