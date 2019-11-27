<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Версия для печати</title>
    </head>
    <body>
        <p>******************************************************************</p>
        <p>SushiStreet</p>
        <p>******************************************************************</p>
        <p>Клиент: <?=$order["order_username"]?></p>
        <p>
            г. <?=$order["city"]?>, д. <?=$order["house"]?>, кв. <?=$order["apartment"]?>, п. <?=$order["podezd"]?>,
            эт. <?=$order["floor"]?> домофон: <?=$order["domofon"]?>
        </p>
        <p><?=$order["tel"]?></p>
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
        <p>Скидка: <?=$order["sales"]?></p>
        <p>Итого: <?=$order["order_information"]["final"]["Итого"]?></p>
    </body>
</html>