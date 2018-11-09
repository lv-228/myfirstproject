function modal(trans_name,id) {
        $('.modal-title').html(trans_name);
        $('#beta_form').attr('action','http://dota.geos.tom.ru:2180/translation/beta');
        $('#input_id').attr('value',id);
    }
$(document).ready(function () {
    $('#button_off').click(function () {
         document.getElementById('link_on'+kostil).click();
    });

    $('#button_on').click(function () {
        document.getElementById('link_off'+kostil).click();
    });

    function submit_form() {
        $('#beta_form').submit();
    }
});