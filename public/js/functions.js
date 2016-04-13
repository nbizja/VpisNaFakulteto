$(document).ready(function() {
    $('#vzdrzevanjeProgramov_fakultete').change(function(){
        var id = $(this).val();
        var i = 0;
        $('#vzdrzevanjeProgramov_programi').children().each(function() {
            if ($(this).attr('data-fakulteta') == id) {
                $(this).show();
                if (i == 0) {
                    $(this).prop('selected', true);
                } else {
                    $(this).prop('selected', false);
                }
                i++;
            } else {
                $(this).prop('selected', false);
                $(this).hide();
            }
        });
    });

    $('#vzdrzevanjeProgramov_programi').change(function() {
        var id = $(this).val();
        var steviloMest;
        $('#vzdrzevanjeProgramov_programi').children().each(function() {
            if ($(this).val() == id) {
                steviloMest = $(this).attr('data-mesta');
                steviloMestOmejitev = $(this).attr('data-mesta_omejitev');
                nacin = $(this).attr('data-nacin');
                vrsta = $(this).attr('data-vrsta');
            }
        });
        $('#stevilo_vpisnih_mest').val(steviloMest);
        $('#stevilo_mest_omejitev').val(steviloMestOmejitev);
        $('#vrsta_studija').val(vrsta);
        $('#nacin_studija').val(nacin);
    });
});