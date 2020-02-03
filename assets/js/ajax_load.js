const ajax_loader = {
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
                const currentId = parseInt($(".table_block").find(".id").html());
                ajax_loader.vars.last_order_id = parseInt($(data).find(".id").html());

                if (currentId < ajax_loader.vars.last_order_id) {
                    $('.table_block').html(data);
                    const audio = $('#signal_new_order').get(0);
                    audio.muted = false;
                    const promise = audio.play();
                    if (promise !== undefined) {
                        promise.then(_ => {
                            // Autoplay started!
                        }).catch(error => {
                            console.log(error)
                            $("#search_tel").submit();
                        });
                    }
                }
                setTimeout(ajax_loader.functions.getOrders, parseInt(ajax_loader.vars.update_time) * 1000);
            });
        }
    }
};
$(document).ready(function () {
    ajax_loader.init();
});