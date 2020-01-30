<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Версия для печати</title>
    </head>
    <body style="font-size: 30px; font-weight: bold; font-family: Verdana,serif; width: 100%; height: 100%;">
        <p>******************************************************************</p>
        <p style="font-size: 35px; text-align: center;">My-fishka.ru</p>
        <p>******************************************************************</p>
        <p>Клиент: <?=$order["order_username"]?></p>
        <p>Тел: <?=$order["tel"]?></p>
        <p>
            Адрес: <br/>
            г. <?=$order["city"]?>, ул. <?=$order["street"]?>,<br/>
            д. <?=$order["house"]?>, кв. <?=$order["apartment"]?>, п. <?=$order["podezd"]?>, эт. <?=$order["floor"]?>
        </p>
        <p>Домофон: <?=$order["domofon"]?></p>
        <p>Тип оплаты: <?=$order["order_information"]["orderInformation"]["Вид оплаты"]?></p>
        <p>Сдача с: <?=round($order["surrender"], 2)?></p>
        <p>Кол-во персон: <?=$order["count_persons"]?></p>
        <p>Коментарий: <?=$order["message"]?></p>
        <p>******************************************************************</p>
        <table>
            <thead>
                <th style="text-align: left;">Название</th>
                <th style="text-align: left;">Кол.</th>
                <th style="text-align: left;">Стоим</th>
            </thead>
            <tbody>
                <?php foreach ($order["order_information"]["products"] as $key => $product): ?>
                <tr>
                    <td style="text-align: left;"><?=$product["name"]?></td>
                    <td style="text-align: left;"><?=$product["count"]?></td>
                    <td style="text-align: right;"><?=$product["price"]?>руб.</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>******************************************************************</p>
        <p>Скидка: <?=$order["sales"]?>%</p>
        <p>Итого:
        <?php $price = $order["order_information"]["final"]["Итого"]; ?>
        <?php if ($order["sales"] == 0): ?>
            <?=$price?>руб.
        <?php else: ?>
            <s><?=$price?>руб.</s> <?=($price-($order["sales"] * $price / 100))?>руб.
        <?php endif; ?>
        </p>
    </body>
</html>