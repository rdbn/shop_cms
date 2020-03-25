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
                    <?=$price?>руб.
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
                    <span class="span_b">Дата: </span></span> <?=(new \DateTime($order["order_date"]))->format("H:i:s d.m.Y") ?>
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
                            <a class="btn btn-success ajax_print" data-id="<?=$order["id"]?>" href="#">Печать</a>
                        <?php else:; ?>
                            <a class="btn btn-primary" href="/order/clone?id=<?=$order["id"]?>">Повторить</a>
                            <a class="btn btn-warning" href="/order/edit?id=<?=$order["id"]?>">Просмотр</a>
                        <?php endif; ?>
                        <a class="btn btn-danger" href="/order/change-status?id=<?=$order["id"]?>&status=<?=\App\Dto\OrderDto::STATUS["delete"]?>">Удалить</a>
                    </div>
                    <div class="total_price">
                        <div class="total_price_cont">
                            <p><span class="span_b">Сумма: </span></p>
                            <p>
                                <?php $price = $order["order_information"]["final"]["Итого"]; ?>
                                <?php if ($order["sales"] == 0): ?>
                                    <?=$price?>руб.
                                <?php else: ?>
                                    <s><?=$price?>руб.</s><br>
                                    <?=($price-($order["sales"] * $price / 100))?>руб.
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
