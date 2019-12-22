var ajax_loader = {
    vars: {
        last_order_id: null,
        current_last_order_id: null,
        update_time: 30,
    },
    init: function () {
        if(typeof(current_page) != 'undefined' && current_page == 1) {
            ajax_loader.functions.getOrders();
        }
    },
    functions: {
        getOrders: function () {
            $.get("/order/ajax" + window.location.search, function (data) {
                ajax_loader.vars.current_last_order_id = parseInt($(".table_block").find(".id").html());
                ajax_loader.vars.last_order_id = parseInt($(data).find(".id").html());

                if (ajax_loader.vars.current_last_order_id < ajax_loader.vars.last_order_id) {
                    $('.table_block').html(data);
                }
            });
            setTimeout(ajax_loader.functions.getOrders, parseInt(ajax_loader.vars.update_time) * 1000);
            if (ajax_loader.vars.current_last_order_id < ajax_loader.vars.last_order_id) {
                new Audio('assets/notif.mp3').play();
            }
        }
    }
};

$(document).ready(function () { ajax_loader.init(); });