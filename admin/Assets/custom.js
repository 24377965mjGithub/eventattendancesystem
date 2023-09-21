$(document).ready(function () {
    $('.sampletime').append(complete_date() + " @ " + complete_time());

    $(".search_driver").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".drivers").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('.send').click(function () {
        sampleNme = $('.name').val();
        $('.loading').show();
        $.post('./action.php', {
            name: $('.name').val(),
            age: $('.age').val(),
            number: $('.number').val(),
            address: $('.address').val()
        }, function () {
            $('.loading').hide();
            $('.persons').append(`
                <b>${sampleNme}</b>
            `)
        })
    })

    $('.click').click(function() {
        window.location.href = "mailto:mjespelita.medivadigital@gmail.com?subject=hello&body=hello body";
    })

    // filter search

    $(".search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".student").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // staff

    $(".search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".staff").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
})