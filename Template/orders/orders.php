<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Список заказов</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/styles.css" crossorigin="anonymous">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="print_tmp_content" class="print_tmp_content"></div>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="row">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li id="fast-click" class="active"><a href="/">Список заказов</a></li>
                            <li><a href="/order/create">Добавить заказ</a></li>
                            <li><a href="/statistics">Статистика</a></li>
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
                    <form method="get" class="form-inline">
                        <div class="form-group">
                            <input id="filter-tel" type="text" class="form-control" name="tel" placeholder="Номер телефона" value="<?=$orderFilter->tel?>" />
                        </div>
                        <button class="btn btn-primary">Найти</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 table_block">
                    <table class="table">
                        <thead>
                            <th>id</th>
                            <th>Цена заказа</th>
                            <th>Доставка</th>
                            <th>Тип оплаты</th>
                            <th>Дата заказа</th>
                            <th>Имя заказчика</th>
                            <th>Телефон заказчика</th>
                            <th>Адрес заказчика</th>
                            <th>Информация о заказе</th>
                            <th>Коментарий</th>
                            <th></th>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr
                                <?php if ($order["status"] == \App\Dto\OrderDto::STATUS["end"] || $order["status"] == \App\Dto\OrderDto::STATUS["clone"]): ?>class="text-muted"<?php endif; ?>
                                <?php if ($order["status"] == \App\Dto\OrderDto::STATUS["in_work"]): ?>class="text-danger"<?php endif; ?>
                            >
                                <td class="id"><?=$order["id"] ?></td>
                                <td>
                                    <?php $price = $order["order_information"]["final"]["Итого"]; ?>
                                    <?php if ($order["sales"] == 0): ?>
                                        <?=$price?>руб.
                                    <?php else: ?>
                                        <s><?=$price?>руб.</s><br>
                                        <?=($price-($order["sales"] * $price / 100))?>руб.
                                    <?php endif; ?>
                                </td>
                                <td><?=$order["order_information"]["orderInformation"]["Доставка"]?></td>
                                <td>
                                <?php if ("Оплата кредитной картой при получении заказа" == trim($order["order_information"]["orderInformation"]["Вид оплаты"])): ?>
                                    Оплата картой
                                <? else: ?>
                                    <?=$order["order_information"]["orderInformation"]["Вид оплаты"];?>
                                <?php endif; ?>
                                </td>
                                <td><?=(new \DateTime($order["order_date"]))->format("H:i:s d.m.Y") ?></td>
                                <td><?=$order["order_username"] ?></td>
                                <td><?=$order["tel"] ?></td>
                                <td>
                                    город: <?=$order["city"] ?><br/>
                                    улица: <?=$order["street"] ?><br/>
                                    дом: <?=$order["house"] ?><br/>
                                    подъезд: <?=$order["podezd"] ?><br/>
                                    этаж: <?=$order["floor"] ?><br/>
                                    квартира: <?=$order["apartment"] ?><br/>
                                    домофон: <?=$order["domofon"] ?>
                                </td>
                                <td>
                                    <?php foreach ($order["order_information"]["products"] as $key => $product): ?>
                                        <?=($key+1)?>: <?=$product["name"]?> (Кол-во: <?=$product["count"]?>)<br/>
                                    <?php endforeach; ?>
                                </td>
                                <td><?=$order["message"]?></td>
                                <td>
                                    <div class="btn-group-vertical">
                                        <?php if ($order["status"] == \App\Dto\OrderDto::STATUS["process"] || $order["status"] == \App\Dto\OrderDto::STATUS["in_work"]): ?>
                                            <a class="btn btn-primary" href="/order/edit?id=<?=$order["id"]?>">Редактировать</a>
                                            <a class="btn btn-warning" href="/order/change-status?id=<?=$order["id"]?>&status=<?=\App\Dto\OrderDto::STATUS["end"]?>">Выполнено</a>
                                            <a class="btn btn-success ajax_print" data-id="<?=$order["id"]?>" href="#">Печать</a>
                                            <?php if ($order["status"] != \App\Dto\OrderDto::STATUS["in_work"]): ?>
                                                <a class="btn btn-default" href="/order/change-status?id=<?=$order["id"]?>&status=<?=\App\Dto\OrderDto::STATUS["in_work"]?>">В работе</a>
                                            <?php endif; ?>
                                        <?php else:; ?>
                                            <a class="btn btn-primary" href="/order/clone?id=<?=$order["id"]?>">Повторить</a>
                                            <a class="btn btn-warning" href="/order/edit?id=<?=$order["id"]?>">Просмотр</a>
                                        <?php endif; ?>
                                        <a class="btn btn-danger" href="/order/change-status?id=<?=$order["id"]?>&status=<?=\App\Dto\OrderDto::STATUS["delete"]?>">Удалить</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php if ($orderFilter->page > 1): ?>
                    <li>
                        <a href="/?page=<?=($orderFilter->page-1)?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li><a href="#"><?=$orderFilter->page?></a></li>
                    <?php if ($orderFilter->limit == count($orders)): ?>
                    <li>
                        <a href="/?page=<?=($orderFilter->page+1)?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <audio id="signal_new_order" class="hidden" src="assets/signal.mp3" type="audio/mpeg" muted preload="none"></audio>

        <script type="application/javascript">var current_page = '<?=$orderFilter->page;?>';</script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="/assets/js/jquery.maskedinput.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/ajax_load.js" crossorigin="anonymous"></script>
        <script src="assets/js/print.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/print.js" crossorigin="anonymous"></script>
        <script type="application/javascript">
            $(document).ready(function () {
                $("#filter-tel").mask("+7 (999) 999-99-99");
            })
        </script>
    </body>
</html>