$(document).ready(function () {
    $('#productsearch-discount').change(function () {

        var labelInput = $(this).closest('div').find('label');
        labelInput.text('Discount - ' + $(this).val());
    })



    $('.product-search input').change(function () {
        $(this).closest('form').submit();
    });

    $("img")
        .on('load', function() {
            //console.log("image loaded correctly");
        })
        .on('error', function() {
            $(this).attr('src', '/img/no-image.png')
        });
});