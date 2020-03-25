var ajax_print = {
    init: function () {
        ajax_print.functions.setListeners();  // Проставим листенеры
    },
    functions: {
        setListeners: function () { // Проставим листенеры
            $(document).on('click', '.ajax_print:not(.disabled)', function (e) { // При нажатии на кнопку печати
                e.preventDefault();
                var id = $(this).data('id'); // Получим ид заказа
                if ($.isNumeric(id)) { // Если верный id
                    const element = $(this);
                    element.addClass('disabled'); // Отклчим кнопку
                    ajax_print.functions.tryPrint(id, element); // Запустим процесс печати
                }
            });
        },
        tryPrint: function (id, element) { // Попробуем распечатать
            $.get("/order/print-version?id="+id, function (data) {
                $('.ajax_print[data-id="'+id+'"]').removeClass('disabled'); // Включим кнопку
                $('.print_tmp_content').html(data); // Поместим html
                printJS('print_tmp_content', 'html'); // Распечатаем
                const elementPrint = element.parent().parent().parent().parent().parent().find(".cp_item_title");
                console.log(elementPrint)
                elementPrint.removeClass("new");
                elementPrint.addClass("print");
            });
            
        }
    }
};


ajax_print.init(); 