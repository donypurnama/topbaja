$('.search-field').on('keyup', function () {
    var value = $(this).val();
    var patt = new RegExp(value, "i");

    $('.live-table').find('tr').each(function () {
        if (!($(this).find('td').text().search(patt) >= 0)) {
            $(this).not('.table-header').hide();
        }
        if (($(this).find('td').text().search(patt) >= 0)) {
            $(this).show();
        }
    });

});