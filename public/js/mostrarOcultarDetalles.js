$(function () {

    $(".hijo button").click(function () {

        let id = this.id.split('_');

        if ($('#' + this.id).text() === 'Mostrar') {

            $('#' + this.id).html('Ocultar')
        } else {

            $('#' + this.id).html('Mostrar')
        }

        $('#' + id[0]).toggleClass('d-none');
    });

})
