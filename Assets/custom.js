$(document).ready(function () {
    // $('.sampletime').append(complete_date() + " @ " + complete_time());

    // $(".search_driver").on("keyup", function () {
    //     var value = $(this).val().toLowerCase();
    //     $(".drivers").filter(function () {
    //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //     });
    // });

    // $('.send').click(function () {
    //     sampleNme = $('.name').val();
    //     $('.loading').show();
    //     $.post('./action.php', {
    //         name: $('.name').val(),
    //         age: $('.age').val(),
    //         number: $('.number').val(),
    //         address: $('.address').val()
    //     }, function () {
    //         $('.loading').hide();
    //         $('.persons').append(`
    //             <b>${sampleNme}</b>
    //         `)
    //     })
    // })

    // $('.click').click(function() {
    //     window.location.href = "mailto:mjespelita.medivadigital@gmail.com?subject=hello&body=hello body";
    // })

    // custom
    
    setInterval(() => {
        $('.datetime').text(complete_date() + " " + complete_time())
        // $('.datetime').append("");
    }, 1000);

    // qrcode gen

    $('.generateqrcode').click(function () {
        let qrcodevalue = $(this).attr('qrcodevalue');

        $('.qrcodetitle').text("Generating QR Code...");

        $('.generatedqrcode').append("");

        $.post('./QRCode Generator/generator.php', {
            value: qrcodevalue
        }, function (data) {
            $('.qrcodetitle').text("QR Code Generated Successfully");
            $('.loadinggen').hide();
            $('.generatedqrcode').append(`
                <img src="./QRCode Generator/${data}"><br>
                <a href="./QRCode Generator/${data}" download>
                    <button class="btn btn-warning">Download QR Code</button>
                </a>
            `);

            // delqrcode 

            $('.delqrcode').click(function () {
                $.post('./QRCode Generator/delqrcode.php', {
                    qrdel: data
                }, function (data) {
                    console.log("Deleted");
                })
            });

        })
    });

    // staff

    $(".search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".event").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(".search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".staff").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

})