<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style type="text/css">
            body {
                margin: 0;
                padding: 0;
            }
            .print-page {
                font-size: 14px;
                font-family: Verdana,serif;
                width: 100%;
                height: 100%;
            }
            .print-head {
                margin: 0;
                padding: 0;
                font-size: 41px;
            }
            .width {
                width: 270px;
            }
            .top0 {
                margin-top: 0;
            }
            .bottom0 {
                margin-bottom: 0;
            }
            .top10 {
                margin-top: 5px;
            }
            .bottom10 {
                margin-bottom: 10px;
            }
            @page:left {
                margin: 0;
            }
            @page:right {
                margin: 0;
            }
            .table-print {
                margin: 0;
                padding: 0;
                text-align: left;
            }
        </style>

        <title>Версия для печати</title>
    </head>
    <body>
        <div class="print-page">
            <p class="print-head bottom0">My-fishka.ru</p>
            <p class="top0 bottom0">******************************************************************</p>
            <p class="width top0 bottom0">id <?=$order["id"]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=date("d.m.Y H:i")?></p>
            <p class="width top10 bottom0">Клиент: <?=$order["order_username"]?></p>
            <p class="width top10 bottom0">Тел: <?=$order["tel"]?></p>
            <p class="width top10 bottom0">
                Адрес: г. <?=$order["city"]?>,<br/> ул. <?=$order["street"]?>,<br/>
                д. <?=$order["house"]?>, п. <?=$order["podezd"]?>, эт. <?=$order["floor"]?>, кв. <?=$order["apartment"]?>
            </p>
            <p class="width top10 bottom0">Домофон: <?=$order["domofon"]?></p>
            <p class="width top10 bottom0">
                Тип оплаты:
                <?php if ("Оплата кредитной картой при получении заказа" == trim($order["order_information"]["orderInformation"]["Вид оплаты"])): ?>
                    Оплата картой
                <? else: ?>
                    <?=$order["order_information"]["orderInformation"]["Вид оплаты"];?>
                <?php endif; ?>
            </p>
            <p class="width top10 bottom0">Сдача с: <?=round($order["surrender"], 2)?></p>
            <p class="width top10 bottom0">Кол-во персон: <?=$order["count_persons"]?></p>
            <p class="width top10 bottom0">Доставка: <?=$order["order_information"]["orderInformation"]["Доставка"]?></p>
            <p class="width top10 bottom0">Коментарий: <?=$order["message"]?></p>
            <p class="top0 top10 bottom0">******************************************************************</p>
            <table class="width bottom0 table-print">
                <thead>
                    <th>Название</th>
                    <th>Кол.</th>
                    <th>Стоим</th>
                </thead>
                <tbody>
                    <?php foreach ($order["order_information"]["products"] as $key => $product): ?>
                    <tr>
                        <td><?=$product["name"]?></td>
                        <td><?=$product["count"]?></td>
                        <td><?=$product["price"]?> р.</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="bottom0">******************************************************************</p>
            <p class="width top0 bottom0">Скидка: <?=$order["sales"]?>%</p>
            <p class="width top10 bottom0">Итого:
            <?php $price = $order["order_information"]["final"]["Итого"]; ?>
            <?php if ($order["sales"] == 0): ?>
                <?=$price?> р.
            <?php else: ?>
                <s><?=$price?> р.</s> <?=($price-($order["sales"] * $price / 100))?> р.
            <?php endif; ?>
            </p>
        </div>
    </body>
</html>