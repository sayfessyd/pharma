function changeView() {
    $('.responsive-table th').css({
        'display': 'none'
    });
    $('.responsive-table td').css({
        'display': 'block'
    });
    $('.responsive-table td:first-child').css({
        'padding-top': '.5em'
    });
    $('.responsive-table td:last-child').css({
        'padding-bottom': '.5em'
    });
    $('[type=checkbox], [type=search], [for=search]').css({
        'display': 'none'
    });
    $('.responsive-table td[data-th]').each(function() {
        $(this).before('<div style="font-weight: bold; width:100%; background-color: #FFEB99; text-indent: 10px;">'+$(this).attr('data-th')+'</div>');
    });
}
function checkAll () {
    $('[type=checkbox]').each(function() {
          this.checked = true;
    });
}
function unCheckall () {
    $('[type=checkbox]').each(function() {
          this.checked = false;
    });
}
function ajouterListe() {
    $('#codes').val( $('#codes').val() + ' ' + $("#liste option:selected").text() );
}
