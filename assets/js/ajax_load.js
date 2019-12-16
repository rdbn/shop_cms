var ajax_loader = { // Автоматическая подгрузка новых заказов
    vars: {
        last_order_id: null, // id последнего заказа
        update_time: 60, // Кол-во секунд периода авто загрузки
        audio: new Audio('assets/notif.mp3')
    },
    init: function () { // Инициализация подгрузки
        console.log(1231231);
        if(typeof(current_page) != 'undefined' && current_page == 1){ // Если это первая страница
            console.log(1231231);
            ajax_loader.functions.getOrders(); // Запустим скрипт
        }
    },
    functions: {
        getOrders: function () { // Получим заказы
            $.getJSON("?get_orders", function (data) {
                var start = ajax_loader.vars.last_order_id;
                Math.max.apply(Math, data.map(function (o) { return o.id; })); // Отсортируем по ID заказы
                ajax_loader.vars.last_order_id = parseInt(data[0].id); // Сохраним ID самого последнего заказа

                if (start) { // Если нужно проверить на новые заказы
                    if (start < ajax_loader.vars.last_order_id) { // Если есть новый заказ
                        ajax_loader.functions.updateOrders(); // Подгрузим новые заказы
                    }
                }
            });
            setTimeout(ajax_loader.functions.getOrders, parseInt(ajax_loader.vars.update_time) * 1000); // Поставим таймер для следующей проверки
        },
        updateOrders: function () { // Подгрузка новых заказов
            $.get("?get_table", function (html_string) {
                $('.table_block').html(html_string);
                ajax_loader.vars.audio.play();
            });
        }
    }

};


ajax_loader.init(); // Запустим автоматическую подгрузку