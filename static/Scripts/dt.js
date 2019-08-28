$(document).ready(function () {

    // $(window).bind('beforeunload', function () {
    //     return 'are you sure you want to leave?';
    // });

    $(function () {
        $('.select2').select()
    });

    $("#submit_task").on("click", function (e) {
        e.preventDefault();
        if ($("#answer").val() == "") {
            $("#answer").css("background", "#f88");
            return;
        }
        var str = $("#users_answer").serialize();
        console.log(str);
        $.ajax({
            url: "",
            type: "POST",
            data: { 'act': 'check_task', 'str': str }
        })
            .done(function () {
                window.location.href = "?act=main";
            });
    });

    /** Добавить номера зачеток */
    $("#add_number").click(function (e) {
        e.preventDefault();
        str = $("#check_books_numbers").val();
        $.ajax({
            url: "",
            type: "POST",
            data: { 'act': 'add_book_numbers', 'str': str },
            cache: false
        }).done(function (msg) {
            if (msg == 0) {
                alert("Добавлено");
                window.location.reload();
            }
            else {
                console.log(msg);
            }
        })
    });

    /** РЕГИСТРАЦИЯ */
    $('#do_reg').click(function (event) {
        event.preventDefault();
        var formValid = true;

        $('#register_form input').each(function () {

            var formGroup = $(this).parents('.form-group');
            var glyphicon = formGroup.find('.form-control-feedback');

            if (!this.checkValidity()) {
                formGroup.addClass('has-error').removeClass('has-success');
                glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');
                formValid = false;
            }
            else {
                formGroup.addClass('has-success').removeClass('has-error');
                glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
            }
        });

        if (formValid) {
            var str = $('#register_form').serialize();
            str = decodeURI(str);
            $.ajax({
                url: "",
                type: "POST",
                data: { 'act': 'do_reg', 'str': str },
                cache: false
            }).done(function (msg) {
                if (msg == 0) {
                    $('#pass-danger').removeClass('hidden');
                    $('#login-danger').addClass('hidden');
                    $('#number-danger').addClass('hidden');
                    hide_input_icons();
                }
                if (msg == 1) {
                    $('#login-danger').removeClass('hidden');
                    $('#pass-danger').addClass('hidden');
                    $('#number-danger').addClass('hidden');
                    hide_input_icons();
                }
                if (msg == 2) {
                    $('#login-danger').addClass('hidden');
                    $('#pass-danger').addClass('hidden');
                    $('#number-danger').removeClass('hidden');
                }
                if (msg == 1000) {
                    window.location.href = "?act=login";
                }
                else {
                    console.log(msg);
                }
            })
        }

        // скрываем значки в инпутах формы
        function hide_input_icons() {
            $('#register_form input').each(function () {
                var formGroup = $(this).parents('.form-group');
                var glyphicon = formGroup.find('.form-control-feedback');
                formGroup.removeClass('has-success');
                glyphicon.removeClass('glyphicon-ok');
            });
        }
    });
    /** РЕГИСТРАЦИЯ КОНЕЦ */

    /** Таблицы */


    if ($.fn.dataTable.isDataTable('#numbers_table')) {
        tests_table = $('#numbers_table').DataTable();
    }
    else {
        tests_table = $('#numbers_table').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }

    $("#students_table tfoot th").each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="' + title + '" />');
    });

    if ($.fn.dataTable.isDataTable('#students_table')) {
        students_table = $('#students_table').DataTable();
    }
    else {
        students_table = $('#students_table').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': true
        });
    }

    // Применить поиск
    students_table.columns().every(function () {
        var that = this;

        $('input', this.footer()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });

    if ($.fn.dataTable.isDataTable('#prices_table1')) {
        tests_table = $('#prices_table1').DataTable();
    }
    else {
        tests_table = $('#prices_table1').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': true,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }

    if ($.fn.dataTable.isDataTable('#prices_table2')) {
        tests_table = $('#prices_table2').DataTable();
    }
    else {
        tests_table = $('#prices_table2').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': true,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }

    if ($.fn.dataTable.isDataTable('#users_table')) {
        tests_table = $('#users_table').DataTable();
    }
    else {
        tests_table = $('#users_table').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }

    if ($.fn.dataTable.isDataTable('#results_table1')) {
        tests_table = $('#results_table1').DataTable();
    }
    else {
        tests_table = $('#results_table1').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }

    if ($.fn.dataTable.isDataTable('#results_table2')) {
        tests_table = $('#results_table2').DataTable();
    }
    else {
        tests_table = $('#results_table2').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }

    if ($.fn.dataTable.isDataTable('#tasks_table')) {
        tests_table = $('#tasks_table').DataTable();
    }
    else {
        tests_table = $('#tasks_table').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': false,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }

    if ($.fn.dataTable.isDataTable('#textures_table')) {
        tests_table = $('#textures_table').DataTable();
    }
    else {
        tests_table = $('#textures_table').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': true,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }

    if ($.fn.dataTable.isDataTable('#manufacturers_table')) {
        tests_table = $('#manufacturers_table').DataTable();
    }
    else {
        tests_table = $('#manufacturers_table').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': true,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }

    if ($.fn.dataTable.isDataTable('#colors_table')) {
        tests_table = $('#colors_table').DataTable();
    }
    else {
        tests_table = $('#colors_table').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': true,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }

    if ($.fn.dataTable.isDataTable('#articles_table')) {
        tests_table = $('#articles_table').DataTable();
    }
    else {
        tests_table = $('#articles_table').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': true,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }

    if ($.fn.dataTable.isDataTable('#coeff_table')) {
        tests_table = $('#coeff_table').DataTable();
    }
    else {
        tests_table = $('#coeff_table').DataTable({
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Все"]],
            "deferRender": true,
            'stateSave': false,
            'select': true,
            'paging': true,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }
});
