<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Создание заказа</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

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
                            <li><a href="/statistics">Статистика</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>
                        Добавить заказ
                        <a href="/order/clone?id=<?=$requestValue["id"]?>" class="btn btn-primary float-right">Повторить</a>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="post">
                        <table class="table">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="create_order_order_username">Имя заказчика</label>
                                        <input required="required" id="create_order_order_username" type="text" name="create_order[order_username]" class="form-control" placeholder="Имя заказчика" value="<?php if (isset($requestValue["order_username"])): ?><?=$requestValue["order_username"]?><?php endif ?>" />
                                        <p class="text-danger"><strong><?php if (isset($errorMessages["orderUsername"])): ?><?=$errorMessages["orderUsername"]?><?php endif ?></strong></p>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="create_order_order_tel">Телефон</label>
                                        <input required="required" id="create_order_order_tel" type="text" name="create_order[tel]" class="form-control" placeholder="Телефон заказчика" value="<?php if (isset($requestValue["tel"])): ?><?=$requestValue["tel"]?><?php endif ?>" />
                                        <p class="text-danger"><strong><?php if (isset($errorMessages["tel"])): ?><?=$errorMessages["tel"]?><?php endif ?></strong></p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <h3>Адрес доставки:</h3>
                        <table class="table">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="create_order_order_city">Населенный пункт</label>
                                        <input id="create_order_order_city" type="text" name="create_order[city]" class="form-control" placeholder="Адрес заказчика(Населенный пункт)" value="<?php if (isset($requestValue["city"])): ?><?=$requestValue["city"]?><?php endif ?>" />
                                        <p class="text-danger"><strong><?php if (isset($errorMessages["city"])): ?><?=$errorMessages["city"]?><?php endif ?></strong></p>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="create_order_order_street">Улица</label>
                                        <input id="create_order_order_street" type="text" name="create_order[street]" class="form-control" placeholder="Адрес заказчика(Улица)" value="<?php if (isset($requestValue["street"])): ?><?=$requestValue["street"]?><?php endif ?>" />
                                        <p class="text-danger"><strong><?php if (isset($errorMessages["street"])): ?><?=$errorMessages["street"]?><?php endif ?></strong></p>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="create_order_order_house">Дом</label>
                                        <input id="create_order_order_house" type="text" name="create_order[house]" class="form-control" placeholder="Адрес заказчика(Дом)" value="<?php if (isset($requestValue["house"])): ?><?=$requestValue["house"]?><?php endif ?>" />
                                        <p class="text-danger"><strong><?php if (isset($errorMessages["house"])): ?><?=$errorMessages["house"]?><?php endif ?></strong></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="create_order_order_podezd">Подъезд</label>
                                        <input id="create_order_order_podezd" type="text" name="create_order[podezd]" class="form-control" placeholder="Адрес заказчика(Подъезд)" value="<?php if (isset($requestValue["podezd"])): ?><?=$requestValue["podezd"]?><?php endif ?>" />
                                        <p class="text-danger"><strong><?php if (isset($errorMessages["podezd"])): ?><?=$errorMessages["podezd"]?><?php endif ?></strong></p>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="create_order_order_apartment">Квартира</label>
                                        <input id="create_order_order_apartment" type="text" name="create_order[apartment]" class="form-control" placeholder="Адрес заказчика(Квартира)" value="<?php if (isset($requestValue["apartment"])): ?><?=$requestValue["apartment"]?><?php endif ?>" />
                                        <p class="text-danger"><strong><?php if (isset($errorMessages["apartment"])): ?><?=$errorMessages["apartment"]?><?php endif ?></strong></p>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="create_order_order_floor">Этаж</label>
                                        <input id="create_order_order_floor" type="text" name="create_order[floor]" class="form-control" placeholder="Адрес заказчика(Этаж)" value="<?php if (isset($requestValue["floor"])): ?><?=$requestValue["floor"]?><?php endif ?>" />
                                        <p class="text-danger"><strong><?php if (isset($errorMessages["floor"])): ?><?=$errorMessages["floor"]?><?php endif ?></strong></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="create_order_order_domofon">Домофон</label>
                                        <input id="create_order_order_domofon" type="text" name="create_order[domofon]" class="form-control" placeholder="Адрес заказчика(Домофон)" value="<?php if (isset($requestValue["domofon"])): ?><?=$requestValue["domofon"]?><?php endif ?>" />
                                        <p class="text-danger"><strong><?php if (isset($errorMessages["domofon"])): ?><?=$errorMessages["domofon"]?><?php endif ?></strong></p>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                        <h3>Информация о заказе:</h3>
                        <p class="text-danger"><strong><?php if (isset($errorMessages["orderInformation"])): ?><?=$errorMessages["orderInformation"]?><?php endif ?></strong></p>
                        <table id="order-information" class="table">
                            <thead>
                                <th>Товар</th>
                                <th>Цена за одну</th>
                                <th>Количество</th>
                                <th>Общая цена</th>
                                <th>
                                    <?php if (isset($requestValue["order_information"]["products"])): ?>
                                        <?php $count = count($requestValue["order_information"]["products"]); ?>
                                        <button class="btn btn-primary add-form-order-product" type="button" data-count="<?=$count?>">Добавить товар</button>
                                    <?php else: ?>
                                        <button class="btn btn-primary add-form-order-product" type="button" data-count="0">Добавить товар</button>
                                    <?php endif;?>
                                </th>
                            </thead>
                            <tbody>
                            <?php if (isset($requestValue["order_information"]["products"])): ?>
                                <?php foreach ($requestValue["order_information"]["products"] as $key => $product): ?>
                                    <tr class="products">
                                        <td>
                                            <input value="<?=$product["name"]?>" name="create_order[order_information][products][<?=$key?>][name]" class="form-control typeahead" type="text" data-provide="typeahead" />
                                        </td>
                                        <td>
                                            <input class="price order-prices-<?=$key?>" name="create_order[order_information][products][<?=$key?>][price]" type="hidden" value="<?=$product["price"]?>" />
                                            <?=$product["price"]?>руб.
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-success add-order" type="button" data-id="<?=$key?>">
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                            </button>
                                                        </span>
                                                        <input name="create_order[order_information][products][<?=$key?>][count]" type="number" class="form-control order-count-<?=$key?>" value="<?=$product["count"]?>" />
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-danger remove-order" type="button" data-id="<?=$key?>">
                                                                <span class="glyphicon glyphicon-minus"></span>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input class="total-price order-total-prices-<?=$key?>" name="create_order[order_information][products][<?=$key?>][price_total]" type="hidden" value="<?=$product["price_total"]?>" />
                                            <span class="price-total-<?=$key?>"><?=$product["price_total"]?></span>руб.
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-element">Удалить</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <input id="create_order_sales" type="hidden" name="create_order[sale]" value="<?php if (isset($requestValue["sales"])): ?><?=$requestValue["sales"]?><?php endif; ?>" />
                            <h5>Скидка:</h5>
                            <div id="btn-group" class="btn-group">
                                <?php foreach (range(1, 10) as $item): ?>
                                    <button type="button" class="sales btn btn-default <?php if (isset($requestValue["sales"]) && $requestValue["sales"] == $item * 5): ?>active<?php endif; ?>" data-sales="10"><?=$item * 5?>%</button>
                                <?php endforeach; ?>
                                <button type="button" class="btn btn-default disabled-sale">Отменить скидку</button>
                            </div>
                        </div>
                        <?php if (isset($requestValue["order_information"]["final"])): ?>
                            <?php $final = $requestValue["order_information"]["final"]; ?>
                            <div class="form-group">
                                <input id="input-total-sum" name="create_order[order_information][final][Сумма]" type="hidden" value="<?=$final["Сумма"]?>" />
                                Сумма:
                                <span id="total-sum" data-sum="<?=$final["Сумма"]?>">
                                    <?php if (!isset($requestValue["sales"]) || $requestValue["sales"] == 0): ?>
                                        <?=$final["Сумма"]?>руб.
                                    <?php else: ?>
                                        <s><?=$final["Сумма"]?>руб.</s>: <?=($final["Сумма"]-($requestValue["sales"] * $final["Сумма"] / 100))?>руб.
                                    <?php endif; ?>
                                </span><br/>
                                <input name="create_order[order_information][final][Доставка]" type="hidden" value="<?=$final["Доставка"]?>" />
                                Доставка: <span id="sum-delivery" data-sum="<?=$final["Доставка"]?>"><?=$final["Доставка"]?></span>руб.<br/>
                                <input id="input-final-total-sum" name="create_order[order_information][final][Итого]" type="hidden" value="<?=$final["Итого"]?>" />
                                Итого: <span id="final-total-sum" data-sum="<?=$final["Итого"]?>">
                                    <?php if (!isset($requestValue["sales"]) || $requestValue["sales"] == 0): ?>
                                        <?=$final["Итого"]?>руб.
                                    <?php else: ?>
                                        <s><?=$final["Итого"]?>руб.</s>:
                                        <?=($final["Итого"]-($requestValue["sales"] * $final["Итого"] / 100)+$final["Доставка"])?>руб.
                                    <?php endif; ?>
                                </span><br/>
                            </div>
                        <?php else: ?>
                            <div class="form-group">
                                <input id="input-total-sum" name="create_order[order_information][final][Сумма]" type="hidden" value="0" />
                                Сумма: <span id="total-sum" data-sum="0">0</span>руб.<br/>
                                <input name="create_order[order_information][final][Доставка]" type="hidden" value="0" />
                                Доставка: <span id="sum-delivery" data-sum="0">0</span>руб.<br/>
                                <input id="input-final-total-sum" name="create_order[order_information][final][Итого]" type="hidden" value="0" />
                                Итого: <span id="final-total-sum" data-sum="0">0</span>руб.<br/>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($requestValue["order_information"]["present"])): ?>
                            <h5>Подарки:</h5>
                            <div class="form-group">
                                <?php foreach ($requestValue["order_information"]["present"] as $information): ?>
                                    <input name="create_order[order_information][present][]" type="hidden" value="<?=$information?>" />
                                    <?=$information?><br/>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <table class="table">
                            <tr>
                                <?php if (isset($requestValue["order_information"]["orderInformation"])): ?>
                                    <?php $orderInformation = $requestValue["order_information"]["orderInformation"]; ?>
                                    <h5>Дополнительная информация:</h5>
                                    <td>
                                        <div class="form-group">
                                            <label for="create_order_payment_type">Оплата</label>
                                            <select id="create_order_payment_type" name="create_order[order_information][orderInformation][Вид оплаты]" class="form-control">
                                                <option <?php if (trim($orderInformation["Вид оплаты"]) == "Оплата наличными"): ?>selected<?php endif; ?> value="Оплата наличными">Оплата наличными</option>
                                                <option <?php if (trim($orderInformation["Вид оплаты"]) == "Оплата картой"): ?>selected<?php endif; ?> value="Оплата картой">Оплата картой</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="create_order_delivery">Доставка</label>
                                            <select id="create_order_delivery" name="create_order[order_information][orderInformation][Доставка]" class="form-control">
                                                <option <?php if (trim($orderInformation["Доставка"]) == "самовывоз"): ?>selected<?php endif; ?> value="самовывоз">самовывоз</option>
                                                <option <?php if (trim($orderInformation["Доставка"]) == "курьером"): ?>selected<?php endif; ?> value="курьером">курьером</option>
                                            </select>
                                        </div>
                                    </td>
                                    <input name="create_order[order_information][orderInformation][Адрес доставки]" type="hidden" value="<?=$orderInformation["Адрес доставки"]?>" />
                                <?php else: ?>
                                    <input name="create_order[order_information][orderInformation][Адрес доставки]" type="hidden" value="" />
                                    <h5>Дополнительная информация:</h5>
                                    <td>
                                    <div class="form-group">
                                        <label for="create_order_payment_type">Оплата</label>
                                        <select id="create_order_payment_type" name="create_order[order_information][orderInformation][Вид оплаты]" class="form-control">
                                            <option value="Оплата наличными">Оплата наличными</option>
                                            <option value="Оплата картой">Оплата картой</option>
                                        </select>
                                    </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="create_order_delivery">Доставка</label>
                                            <select id="create_order_delivery" name="create_order[order_information][orderInformation][Доставка]" class="form-control">
                                                <option value="самовывоз">самовывоз</option>
                                                <option value="курьером">курьером</option>
                                            </select>
                                            <input name="create_order[order_information][orderInformation][Адрес доставки]" type="hidden" value="" />
                                        </div>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <div class="form-group">
                                        <label for="create_order_courier_name">Имя курьера:</label>
                                        <select id="create_order_courier_name" name="create_order[courier_name]" class="form-control">
                                            <option value="" selected>Выберите имя</option>
                                            <option value="Сергей" <?php if (isset($requestValue["courier_name"]) && $requestValue["courier_name"] == "Сергей"): ?>selected<?php endif; ?>>Сергей</option>
                                            <option value="Алексей" <?php if (isset($requestValue["courier_name"]) && $requestValue["courier_name"] == "Алексей"): ?>selected<?php endif; ?>>Алексей</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="form-group">
                            <h5>Количество персон:</h5>
                            <?php if (!isset($requestValue["count_persons"])):?>
                                <?php $requestValue["count_persons"] = 1 ?>
                            <?php endif; ?>

                            <?php foreach (range(1, 6) as $value):?>
                                <label for="count_person_<?=$value?>" class="radio-inline">
                                    <input id="count_person_<?=$value?>" type="radio" name="create_order[count_persons]" value="<?=$value?>" <?php if ($requestValue["count_persons"] == $value):?>checked<?php endif; ?> /><?=$value?>
                                </label>
                            <?php endforeach;?>
                        </div>
                        <div class="form-group">
                            <label for="surrender">Сдача:</label>
                            <input id="surrender" type="text" name="create_order[surrender]" value="<?php if (isset($requestValue["surrender"])): ?><?=round((float)$requestValue["surrender"], 2)?><?php endif ?>" />
                        </div>
                        <div class="form-group">
                            <label for="create_order_message">Коментарий</label>
                            <textarea id="create_order_message" name="create_order[message]" class="form-control" rows="5"><?php if (isset($requestValue["message"])): ?><?=$requestValue["message"]?><?php endif ?></textarea>
                        </div>
                        <button class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
        <script src="/assets/js/bootstrap3-typeahead.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="/assets/js/jquery.maskedinput.min.js" crossorigin="anonymous"></script>
        <script type="application/javascript">
            function totalSum() {
                var totalSum = 0;
                $("#order-information .products").each(function () {
                    var totalPrice = parseFloat($(this).find(".total-price").val())
                    if (totalPrice > 0) {
                        totalSum += totalPrice;
                    }
                });
                $("#total-sum").html(totalSum + 'руб.');
                $("#input-total-sum").val(totalSum);

                return totalSum;
            }
            function finalTotalSum() {
                var valueTotalSum = totalSum();
                var sumDelivery = parseFloat($("#sum-delivery").attr("data-sum"));

                $("#final-total-sum").html(parseFloat(valueTotalSum) + sumDelivery + 'руб.');
                $("#input-final-total-sum").val(parseFloat(valueTotalSum) + sumDelivery);
            }
            $(document).ready(function () {
                $("#order-information tbody").on("click", ".remove-element", function () {
                    $(this).parent().parent().remove();
                    finalTotalSum();
                });
                $("#btn-group .sales").click(function () {
                    $("#create_order_sales").val($(this).attr("data-sales"));
                    if (!$(this).hasClass("active")) {
                        $(this).parent().find(".sales").each(function () {
                            $(this).removeClass("active");
                        });
                        $(this).addClass("active");
                    }
                    var saleValue = parseInt($(this).html());
                    var sumDelivery = parseFloat($("#sum-delivery").attr("data-sum"));
                    var valueTotalSum = totalSum();

                    valueTotalSum -= (saleValue * valueTotalSum / 100);
                    $("#total-sum").html('<s>'+$("#input-total-sum").val()+'руб.</s>: ' + valueTotalSum + 'руб.');
                    $("#final-total-sum").html('<s>'+$("#input-final-total-sum").val()+'руб.</s>: ' + (sumDelivery + valueTotalSum) + 'руб.');
                });
                $(".disabled-sale").click(function () {
                    $("#create_order_sales").val(0);
                    $(this).parent().find(".sales").each(function () {
                        $(this).removeClass("active");
                    });
                    finalTotalSum();
                });
                $("#order-information tbody").on("click", ".add-order", function() {
                    var element = $(this);
                    var id = $(this).attr("data-id");
                    var price = parseFloat($(".order-prices-" + id).val());
                    var countElement = $(".order-count-" + id);
                    var count = parseInt(countElement.val()) + 1;
                    countElement.val(count);

                    var totalPrice = price * count;
                    $(".price-total-"+id).html(totalPrice);
                    $(".order-total-prices-"+id).val(totalPrice);

                    finalTotalSum();
                });
                $("#order-information tbody").on("click", ".remove-order", function() {
                    var id = $(this).attr("data-id");
                    var countElement = $(".order-count-" + id);
                    var price = parseFloat($(".order-prices-" + id).val());
                    var count = parseInt(countElement.val()) - 1;
                    if (count > 0) {
                        countElement.val(count);

                        var totalPrice = price * count;
                        $(".price-total-" + id).html(totalPrice);
                        $(".order-total-prices-"+id).val(totalPrice);

                        finalTotalSum();
                    }
                });
                $(".add-form-order-product").click(function () {
                    var count = $(this).attr("data-count");
                    $(this).attr("data-count", parseInt(count) + 1);

                    var html = '<tr class="products"><td>' +
'<input value="" name="create_order[order_information][products]['+count+'][name]" class="form-control typeahead" type="text" data-provide="typeahead" data-count="'+count+'" />' +
'</td><td><input class="price order-prices-'+count+'" name="create_order[order_information][products]['+count+'][price]" type="hidden" value="" />' +
'<span class="span-order-prices-'+count+'"></span>руб.</td><td><div class="row"><div class="col-lg-6"><div class="input-group"><span class="input-group-btn">' +
'<button class="btn btn-success add-order" type="button" data-id="'+count+'"><span class="glyphicon glyphicon-plus"></span></button></span>' +
'<input name="create_order[order_information][products]['+count+'][count]" type="number" class="form-control order-count-'+count+'" value="1" />' +
'<span class="input-group-btn"><button class="btn btn-danger remove-order" type="button" data-id="'+count+'"><span class="glyphicon glyphicon-minus"></span></button></span>' +
'</div></div></div></td><td>' +
'<input class="total-price order-total-prices-'+count+'" name="create_order[order_information][products]['+count+'][price_total]" type="hidden" value="0" />' +
'<span class="price-total-'+count+'">0</span>руб.</td><td><button type="button" class="btn btn-danger remove-element">Удалить</button></td></tr>';

                    $("#order-information tbody").append(html);
                });

                $("#order-information tbody").on("focus", ".typeahead", function () {
                    var element = $(this);
                    element.typeahead({
                        source: function (query, result) {
                            $.get("/product/search", {query: query}, function (data) {
                                result($.map(data, function (item) {
                                    return item;
                                }));
                            });
                        },
                        updater: function(selection){
                            var count = element.attr("data-count");
                            element.parent().parent().find(".order-prices-" + count).val(parseFloat(selection.price));
                            element.parent().parent().find(".span-order-prices-" + count).html(parseFloat(selection.price));

                            element.parent().parent().find(".order-total-prices-" + count).val(parseFloat(selection.price));
                            element.parent().parent().find(".price-total-" + count).html(parseFloat(selection.price));

                            finalTotalSum();
                            return selection;
                        }
                    });
                });

                $("#create_order_order_tel").mask("+7 (999) 999-99-99");
            });
        </script>
    </body>
</html>