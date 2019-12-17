var ajax_loader = { // Автоматическая подгрузка новых заказов
    vars: {
        last_order_id: null, // id последнего заказа
        update_time: 60, // Кол-во секунд периода авто загрузки
        audio: new Audio('assets/notif.mp3')
    },
    init: function () { // Инициализация подгрузки
        if(typeof(current_page) != 'undefined' && current_page == 1){ // Если это первая страница
            ajax_loader.functions.getOrders(); // Запустим скрипт
        }
    },
    functions: {
        getOrders: function () { // Получим заказы
            $.get("/order/ajax" + window.location.search, function (data) {
                var currentLastId = parseInt($(".table_block").find(".id").html());
                ajax_loader.vars.last_order_id = parseInt($(data).find(".id").html()); // Сохраним ID самого последнего заказа

                if (currentLastId < ajax_loader.vars.last_order_id) { // Если есть новый заказ
                    $('.table_block').html(data);
                    ajax_loader.vars.audio.play();
                }
            });
            setTimeout(ajax_loader.functions.getOrders, parseInt(ajax_loader.vars.update_time) * 1000); // Поставим таймер для следующей проверки
        }
    }

};

ajax_loader.init(); // Запустим автоматическую подгрузку