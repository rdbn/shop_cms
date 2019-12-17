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
            <?php if ($order["status"] == \App\Dto\OrderDto::STATUS["end"]): ?>class="text-muted"<?php endif; ?>
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
                    <?php endif; ?>
                    <a class="btn btn-danger" href="/order/change-status?id=<?=$order["id"]?>&status=<?=\App\Dto\OrderDto::STATUS["delete"]?>">Удалить</a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>