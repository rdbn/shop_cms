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
        <div class="col-lg-12 table_block top20">
            <div class="cp_list">
            <!-- new -->
            <?php foreach ($orders as $index => $order): ?>
                <div class="cp_item">
                    <div class="cp_item_title <?php if ($order["status"] == \App\Dto\OrderDto::STATUS["process"]): ?>new<?php endif; ?><?php if ($order["status"] == \App\Dto\OrderDto::STATUS["clone"]): ?>end<?php endif; ?><?php if ($order["status"] == \App\Dto\OrderDto::STATUS["in_work"]): ?>print<?php endif; ?><?php if ($order["status"] == \App\Dto\OrderDto::STATUS["end"]): ?>end<?php endif; ?>">
                        <div class="cp_item_title_inner">
                            <div class="item_title_pos"><span class="span_b">id <span class="<?php if ($index == 0): ?>id<?php endif; ?>"><?=$order["id"] ?></span></span></div>
                            <div class="item_title_pos"><span class="span_b">Дата: </span> <?=(new \DateTime($order["order_date"]))->format("d.m.Y H:i") ?> </div>
                            <div class="item_title_pos"><span class="span_b">Имя:</span> <?=$order["order_username"] ?> </div>
                            <div class="item_title_pos"><span class="span_b">Телефон:</span> <?=$order["tel"] ?></div>
                            <div class="item_title_pos"><span class="span_b">Сумма:</span>
                                <?php $price = $order["order_information"]["final"]["Итого"]; ?>
                                <?php if ($order["sales"] == 0): ?>
                                    <?=number_format($price, 0, ",", "")?> р.
                                <?php else: ?>
                                    <?=number_format(($price-($order["sales"] * $price / 100)), 0, ",", "")?> р.
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="cp_item_body">
                        <div class="row order_table">
                            <div class="col-lg-3">Информация о заказе</div>
                            <div class="col-lg-3">Адрес доставки</div>
                            <div class="col-lg-4">Содержание заказа</div>
                            <div class="col-lg-2 order_table__last">Управление заказом</div>
                        </div>
                        <div class="row order_table__item">
                            <div class="col-lg-3 order_table__first"><span class="span_b">id <?=$order["id"] ?> </span><br>
                                <span class="span_b">Дата: </span></span> <?=(new \DateTime($order["order_date"]))->format("d.m.Y H:i") ?>
                                <br>
                                <span class="span_b">Имя:</span> <?=$order["order_username"] ?><br>
                                <p class="phone"><span class="span_b">Телефон:</span> <?=$order["tel"] ?></p>
                                <span class="span_b">Тип доставки:</span> <?=$order["order_information"]["orderInformation"]["Доставка"]?><br>
                                <span class="span_b">Вид оплаты:</span>
                                <?php if ("Оплата кредитной картой при получении заказа" == trim($order["order_information"]["orderInformation"]["Вид оплаты"])): ?>
                                    Оплата картой
                                <? else: ?>
                                    <?=$order["order_information"]["orderInformation"]["Вид оплаты"];?>
                                <?php endif; ?>
                                <br>
                                <span class="span_b">Сдача c:</span> <?=number_format($order["surrender"], 0, '.', '') ?><br>
                                <span class="span_b">Кол-во персон:</span> <?=$order["count_persons"] ?><br>
                                <span class="span_b">Комментарий:</span> <?=$order["message"]?>
                            </div>
                            <div class="col-lg-3">
                                <div class="order_table__item__adres">
                                    <span class="span_b">город:</span> <?=$order["city"] ?><br>
                                    <span class="span_b">улица:</span> <?=$order["street"] ?><br>
                                    <span class="span_b">дом:</span> <?=$order["house"] ?><br>
                                    <span class="span_b">подъезд:</span> <?=$order["podezd"] ?><br>
                                    <span class="span_b">этаж:</span> <?=$order["floor"] ?><br>
                                    <span class="span_b">квартира:</span> <?=$order["apartment"] ?><br>
                                    <span class="span_b">домофон:</span> <?=$order["domofon"] ?></div>
                            </div>
                            <div class="col-lg-4">
                                <?php foreach ($order["order_information"]["products"] as $key => $product): ?>
                                    <span class="span_b"><?=($key+1)?>:</span> <?=$product["name"]?> (Кол-во: <?=$product["count"]?>)<br/>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-lg-2 order_table__last">
                                <div class="btn-group-vertical">
                                    <?php if ($order["status"] == \App\Dto\OrderDto::STATUS["process"] || $order["status"] == \App\Dto\OrderDto::STATUS["in_work"]): ?>
                                        <a class="btn btn-primary" href="/order/edit?id=<?=$order["id"]?>">Редактировать</a>
                                        <a class="btn btn-warning" href="/order/change-status?id=<?=$order["id"]?>&status=<?=\App\Dto\OrderDto::STATUS["end"]?>">Выполнено</a>
                                    <?php else:; ?>
                                        <a class="btn btn-primary" href="/order/clone?id=<?=$order["id"]?>">Повторить</a>
                                        <a class="btn btn-warning" href="/order/edit?id=<?=$order["id"]?>">Просмотр</a>
                                    <?php endif; ?>
                                    <a class="btn btn-success ajax_print" data-id="<?=$order["id"]?>" href="#">Печать</a>
                                    <a class="btn btn-danger" href="/order/change-status?id=<?=$order["id"]?>&status=<?=\App\Dto\OrderDto::STATUS["delete"]?>">Удалить</a>
                                </div>
                                <div class="total_price">
                                    <div class="total_price_cont">
                                        <p><span class="span_b">Сумма: </span></p>
                                        <p>
                                            <?php $price = $order["order_information"]["final"]["Итого"]; ?>
                                            <?php if ($order["sales"] == 0): ?>
                                                <?=number_format($price, 0, ",", "")?> р.
                                            <?php else: ?>
                                                <s><?=number_format($price, 0, ",", "")?> р.</s><br>
                                                <?=number_format(($price-($order["sales"] * $price / 100)), 0, ",", "")?> р.
                                            <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
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