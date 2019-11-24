<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Список заказов</title>
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
                            <li class="active"><a href="/">Список заказов</a></li>
                            <li><a href="/order/create">Добавить заказ</a></li>
                            <li><a href="#">Склад</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Список заказов</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table">
                        <thead>
                            <th>id</th>
                            <th>Цена заказа</th>
                            <th>Тип оплаты</th>
                            <th>Дата заказа</th>
                            <th>Имя заказчика</th>
                            <th>Телефон заказчика</th>
                            <th>Адрес заказчика</th>
                            <th>Информация о заказе</th>
                            <th></th>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?=$order["id"] ?></td>
                                <td>
                                    <?php $price = $order["order_information"]["final"]["Итого"]; ?>
                                    <?php if ($order["sales"] == 0): ?>
                                        <?=$price?>руб.
                                    <?php else: ?>
                                        <s><?=$price?>руб.</s><br>
                                        <?=($price-($order["sales"] * $price / 100))?>руб.
                                    <?php endif; ?>
                                </td>
                                <td><?=$order["order_information"]["orderInformation"]["Вид оплаты"];?></td>
                                <td><?=(new \DateTime($order["order_date"]))->format("H:i:s d.m.Y") ?></td>
                                <td><?=$order["order_username"] ?></td>
                                <td><?=$order["tel"] ?></td>
                                <td>
                                    город: <?=$order["city"] ?><br/>
                                    дом: <?=$order["house"] ?><br/>
                                    подъезд: <?=$order["podezd"] ?><br/>
                                    этаж: <?=$order["floor"] ?><br/>
                                    квартира: <?=$order["apartment"] ?><br/>
                                    домофон: <?=$order["domofon"] ?>
                                </td>
                                <td>
                                    <?php foreach ($order["order_information"]["products"] as $key => $product): ?>
                                        <?=($key+1)?>: <?=$product[0]?> (Кол-во: <?=$product[1]["count"]?>)<br/>
                                    <?php endforeach; ?>
                                </td>
                                <td>
                                    <div class="btn-group-vertical">
                                        <a class="btn btn-primary" href="/order/edit?id=<?=$order["id"]?>">Редактировать</a>
                                        <a class="btn btn-warning" href="/order/change-status?id=<?=$order["id"]?>">Выполнено</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
</html>