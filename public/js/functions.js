$(document).ready(function() {
    $('#vzdrzevanjeProgramov_fakultete').change(function(){
        var id = $(this).val();

        $('#vzdrzevanjeProgramov_programi').children().each(function() {
            if ($(this).attr('data-fakulteta') == -1) {
                $(this).show();
                $(this).prop('selected', true);
            } else if ($(this).attr('data-fakulteta') == id) {
                $(this).show();
                $(this).prop('selected', false);
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