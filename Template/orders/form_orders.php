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
                            <label for="create_order_order_username">Имя заказчика</label>
                            <input required="required" id="create_order_order_username" type="text" name="create_order[order_username]" class="form-control" placeholder="Имя заказчика" value="<?php if (isset($requestValue["order_username"])): ?><?=$requestValue["order_username"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["orderUsername"])): ?><?=$errorMessages["orderUsername"]?><?php endif ?></strong></p>
                        </div>
                        <div class="form-group">
                            <label for="create_order_order_tel">Телефон</label>
                            <input required="required" id="create_order_order_tel" type="number" name="create_order[tel]" class="form-control" placeholder="Телефон заказчика" value="<?php if (isset($requestValue["tel"])): ?><?=$requestValue["tel"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["tel"])): ?><?=$errorMessages["tel"]?><?php endif ?></strong></p>
                        </div>
                        <h3>Адрес доставки:</h3>
                        <div class="form-group">
                            <h4>Если заказ пришел с сайта:</h4>
                            <label for="create_order_order_address"></label>
                            <input id="create_order_order_address" type="text" name="create_order[address]" class="form-control" placeholder="Адрес заказчика" value="<?php if (isset($requestValue["address"])): ?><?=$requestValue["address"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["address"])): ?><?=$errorMessages["address"]?><?php endif ?></strong></p>
                        </div>
                        <h4>Если заказ заведен в ручную:</h4>
                        <div class="form-group">
                            <label for="create_order_order_city">Город</label>
                            <input id="create_order_order_city" type="text" name="create_order[city]" class="form-control" placeholder="Адрес заказчика(Город)" value="<?php if (isset($requestValue["city"])): ?><?=$requestValue["city"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["city"])): ?><?=$errorMessages["city"]?><?php endif ?></strong></p>
                        </div>
                        <div class="form-group">
                            <label for="create_order_order_street">Улица</label>
                            <input id="create_order_order_street" type="text" name="create_order[street]" class="form-control" placeholder="Адрес заказчика(Улица)" value="<?php if (isset($requestValue["street"])): ?><?=$requestValue["street"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["street"])): ?><?=$errorMessages["street"]?><?php endif ?></strong></p>
                        </div>
                        <div class="form-group">
                            <label for="create_order_order_house">Дом</label>
                            <input id="create_order_order_house" type="text" name="create_order[house]" class="form-control" placeholder="Адрес заказчика(Дом)" value="<?php if (isset($requestValue["house"])): ?><?=$requestValue["house"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["house"])): ?><?=$errorMessages["house"]?><?php endif ?></strong></p>
                        </div>
                        <div class="form-group">
                            <label for="create_order_order_podezd">Подъезд</label>
                            <input id="create_order_order_podezd" type="text" name="create_order[podezd]" class="form-control" placeholder="Адрес заказчика(Подъезд)" value="<?php if (isset($requestValue["podezd"])): ?><?=$requestValue["podezd"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["podezd"])): ?><?=$errorMessages["podezd"]?><?php endif ?></strong></p>
                        </div>
                        <div class="form-group">
                            <label for="create_order_order_apartment">Квартира</label>
                            <input id="create_order_order_apartment" type="text" name="create_order[apartment]" class="form-control" placeholder="Адрес заказчика(Квартира)" value="<?php if (isset($requestValue["apartment"])): ?><?=$requestValue["apartment"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["apartment"])): ?><?=$errorMessages["apartment"]?><?php endif ?></strong></p>
                        </div>
                        <div class="form-group">
                            <label for="create_order_order_floor">Этаж</label>
                            <input id="create_order_order_floor" type="text" name="create_order[floor]" class="form-control" placeholder="Адрес заказчика(Этаж)" value="<?php if (isset($requestValue["floor"])): ?><?=$requestValue["floor"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["floor"])): ?><?=$errorMessages["floor"]?><?php endif ?></strong></p>
                        </div>
                        <div class="form-group">
                            <label for="create_order_order_domofon">Домофон</label>
                            <input id="create_order_order_domofon" type="text" name="create_order[domofon]" class="form-control" placeholder="Адрес заказчика(Домофон)" value="<?php if (isset($requestValue["domofon"])): ?><?=$requestValue["domofon"]?><?php endif ?>" />
                            <p class="text-danger"><strong><?php if (isset($errorMessages["domofon"])): ?><?=$errorMessages["domofon"]?><?php endif ?></strong></p>
                        </div>
                        <h3>Информация о заказе:</h3>
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
                                            <input value="<?=$product[0]?>" name="create_order[order_information][product][<?=$key?>][name]" class="form-control typeahead" type="text" data-provide="typeahead" />
                                        </td>
                                        <td>
                                            <input class="price order-prices-<?=$key?>" name="create_order[order_information][product][<?=$key?>][price]" type="hidden" value="<?=$product[1]["price"]?>" />
                                            <?=$product[1]["price"]?>руб.
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
                                                        <input name="create_order[order_information][product][<?=$key?>][count]" type="number" class="form-control order-count-<?=$key?>" value="<?=$product[1]["count"]?>" />
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
                                            <input class="total-price order-total-prices-<?=$key?>" name="create_order[order_information][product][<?=$key?>][price_total]" type="hidden" value="<?=$product[1]["price_total"]?>" />
                                            <span class="price-total-<?=$key?>"><?=$product[1]["price_total"]?></span>руб.
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
                            <h5>Скидка:</h5>
                            <div id="btn-group" class="btn-group">
                                <button type="button" class="btn btn-default">10%</button>
                                <button type="button" class="btn btn-default">20%</button>
                                <button type="button" class="btn btn-default">30%</button>
                                <button type="button" class="btn btn-default disabled-sale">Отменить скидку</button>
                            </div>
                        </div>
                        <?php if (isset($requestValue["order_information"]["final"])): ?>
                            <?php $final = $requestValue["order_information"]["final"]; ?>
                            <div class="form-group">
                                <input id="input-total-sum" name="create_order[order_information][final][Сумма]" type="hidden" value="<?=$final["Сумма"]?>" />
                                Сумма: <span id="total-sum" data-sum="<?=$final["Сумма"]?>"><?=$final["Сумма"]?></span>руб.<br/>
                                <input name="create_order[order_information][final][Доставка]" type="hidden" value="<?=$final["Доставка"]?>" />
                                Доставка: <span id="sum-delivery" data-sum="<?=$final["Доставка"]?>"><?=$final["Доставка"]?></span>руб.<br/>
                                <input id="input-final-total-sum" name="create_order[order_information][final][Итого]" type="hidden" value="<?=$final["Итого"]?>" />
                                Итого: <span id="final-total-sum" data-sum="<?=$final["Итого"]?>"><?=$final["Итого"]?></span>руб.<br/>
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
                        <?php if (isset($requestValue["order_information"]["orderInformation"])): ?>
                            <?php $orderInformation = $requestValue["order_information"]["orderInformation"]; ?>
                            <h5>Дополнительная информация:</h5>
                            <div class="form-group">
                                <input name="create_order[order_information][orderInformation][Вид оплаты]" type="hidden" value="<?=$orderInformation["Вид оплаты"]?>" />
                                Вид оплаты: <?=$orderInformation["Вид оплаты"]?><br/>
                                <input name="create_order[order_information][orderInformation][Доставка]" type="hidden" value="<?=$orderInformation["Доставка"]?>" />
                                Доставка: <?=$orderInformation["Доставка"]?><br/>
                                <input name="create_order[order_information][orderInformation][Адрес доставки]" type="hidden" value="<?=$orderInformation["Адрес доставки"]?>" />
                                Адрес доставки: <?=$orderInformation["Адрес доставки"]?><br/>
                            </div>
                        <?php else: ?>
                            <input name="create_order[order_information][orderInformation][Адрес доставки]" type="hidden" value="" />
                            <h5>Дополнительная информация:</h5>
                            <div class="form-group">
                                <select name="create_order[order_information][orderInformation][Вид оплаты]" class="form-control">
                                    <option value="Оплата наличными">Оплата наличными</option>
                                    <option value="Оплата картой">Оплата картой</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input name="create_order[order_information][orderInformation][Доставка]" class="form-control" type="text" value="Курьером" placeholder="Доставка" />
                            </div>
                        <?php endif; ?>
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
        <script type="application/javascript">
            function totalSum() {
                var totalSum = 0;
                $("#order-information .products").each(function () {
                    var totalPrice = parseFloat($(this).find(".total-price").val())
                    if (totalPrice > 0) {
                        totalSum += totalPrice;
                    }
                });
                $("#total-sum").html(totalSum);
                $("#input-total-sum").val(totalSum);

                return totalSum;
            }
            function finalTotalSum() {
                var valueTotalSum = totalSum();
                var sumDelivery = parseFloat($("#sum-delivery").attr("data-sum"));

                $("#final-total-sum").html(parseFloat(valueTotalSum) + sumDelivery);
                $("#input-final-total-sum").val(parseFloat(valueTotalSum) + sumDelivery);
            }
            $(document).ready(function () {
                $("#order-information tbody").on("click", ".remove-element", function () {
                    $(this).parent().parent().remove();
                    finalTotalSum();
                });
                $("#btn-group button").click(function () {
                    var saleValue = parseInt($(this).html());
                    var sumDelivery = parseFloat($("#sum-delivery").attr("data-sum"));
                    var valueTotalSum = totalSum();

                    valueTotalSum -= (saleValue * valueTotalSum / 100);
                    $("#total-sum").html(valueTotalSum);
                    $("#input-total-sum").val(valueTotalSum);

                    $("#final-total-sum").html(sumDelivery + valueTotalSum);
                    $("#input-final-total-sum").html(sumDelivery + valueTotalSum);
                });
                $(".disabled-sale").click(function () {
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
'<input value="" name="create_order[order_information][product]['+count+'][name]" class="form-control typeahead" type="text" data-provide="typeahead" data-count="'+count+'" />' +
'</td><td><input class="price order-prices-'+count+'" name="create_order[order_information][product]['+count+'][price]" type="hidden" value="" />' +
'<span class="span-order-prices-'+count+'"></span>руб.</td><td><div class="row"><div class="col-lg-6"><div class="input-group"><span class="input-group-btn">' +
'<button class="btn btn-success add-order" type="button" data-id="'+count+'"><span class="glyphicon glyphicon-plus"></span></button></span>' +
'<input name="create_order[order_information][product]['+count+'][count]" type="number" class="form-control order-count-'+count+'" value="1" />' +
'<span class="input-group-btn"><button class="btn btn-danger remove-order" type="button" data-id="'+count+'"><span class="glyphicon glyphicon-minus"></span></button></span>' +
'</div></div></div></td><td>' +
'<input class="total-price order-total-prices-'+count+'" name="create_order[order_information][product]['+count+'][price_total]" type="hidden" value="0" />' +
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
            });
        </script>
    </body>
</html>