<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Создание заказа</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
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
                            <li><a href="/order/create">Добавить заказ</a></li>
                            <li class="active"><a href="/statistics">Статистика</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <form method="get" class="form-inline">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input id="date" name="date" required="required" type="text" class="form-control" placeholder="Дата" value="<?=$statisticFilterDto->date?>" />
                        </div>
                        <div class="form-group">
                            <select id="hour_from" name="hour_from" class="form-control">
                                <option value="" selected>Выберите час(от)</option>
                                <?php foreach (range(0, 23) as $hour): ?>
                                    <option <?php if ($statisticFilterDto->hourFrom != "" && !is_null($statisticFilterDto->hourFrom) && $statisticFilterDto->hourFrom == $hour): ?>selected<?php endif; ?> value="<?=$hour?>"><?=$hour?>:00</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="hour_to" name="hour_to" class="form-control">
                                <option value="" selected>Выберите час(до)</option>
                                <?php foreach (range(0, 23) as $hour): ?>
                                    <option <?php if ($statisticFilterDto->hourTo != "" && !is_null($statisticFilterDto->hourTo) && $statisticFilterDto->hourTo == $hour): ?>selected<?php endif; ?> value="<?=$hour?>"><?=$hour?>:00</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="group_by" name="group_by" class="form-control">
                                <?php foreach ($statisticFilterDto->getGroupBys() as $index => $groupByType): ?>
                                    <option <?php if ($statisticFilterDto->groupBy == $index): ?>selected<?php endif; ?> value="<?=$index?>"><?=$groupByType?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="order_id" type="text" class="form-control" placeholder="Номер заказа" value="<?=$statisticFilterDto->orderId?>" />
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input id="product" type="text" class="form-control" placeholder="Название продукта" value="<?=$statisticFilterDto->product?>" />
                        </div>
                        <div class="checkbox">
                            <label>
                                <input id="is_end_order" name="is_end_order" type="checkbox" <?php if ($statisticFilterDto->isEndOrder):?>checked<?php endif; ?> /> Только завершенные заказы
                            </label>
                        </div>
                        <input type="hidden" name="page" value="<?=$statisticFilterDto->page?>" />
                        <input type="hidden" name="limit" value="<?=$statisticFilterDto->limit?>" />
                        <button class="btn btn-primary">Фильтровать</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table">
                        <thead>
                            <th>Название(id)</th>
                            <th>Количество товар</th>
                            <th>Стоимость товаров</th>
                        </thead>
                        <tbody>
                            <?php foreach ($statistics as $statistic): ?>
                                <tr>
                                    <td><?=$statistic["name"]?></td>
                                    <td><?=$statistic["count"]?></td>
                                    <td><?=number_format($statistic["price"], 2)?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php $query = [] ?>
                            <?php foreach ($requestQuery as $name => $value): ?>
                                <?php $query[$name] = "{$name}={$value}" ?>
                            <?php endforeach; ?>
                            <?php if ($statisticFilterDto->page > 1): ?>
                                <?php $page = $statisticFilterDto->page - 1; ?>
                                <?php $query["page"] = "page={$page}"?>
                                <li>
                                    <a href="/statistics?<?=implode("&", $query)?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li><a href="#"><?=$statisticFilterDto->page?></a></li>
                            <?php if ($statisticFilterDto->limit == count($statistics)): ?>
                                <?php $page = $statisticFilterDto->page + 1; ?>
                                <?php $query["page"] = "page={$page}"?>
                                <li>
                                    <a href="/statistics?<?=implode("&", $query)?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
        <script src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="/assets/js/bootstrap3-typeahead.min.js"></script>
        <script type="application/javascript">
            $(document).ready(function () {
                var dateElement = $('#date');
                dateElement.daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        format: 'DD.MM.YYYY',
                        cancelLabel: 'Clear'
                    }
                });

                dateElement.on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD.MM.YYYY') + ' - ' + picker.endDate.format('DD.MM.YYYY'));
                });

                $("#product").typeahead({
                    source: function (query, result) {
                        $.get("/statistics/product/search", {query: query}, function (data) {
                            result($.map(data, function (item) {
                                return item;
                            }));
                        });
                    }
                });
            });
        </script>
    </body>
</html>