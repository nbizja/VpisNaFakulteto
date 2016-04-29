$(document).ready(function() {
    $('#vzdrzevanjeProgramov_programi').ready(function(){
        $('#vzdrzevanjeProgramov_programi').trigger("change");
    });

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

        $('#vzdrzevanjeProgramov_programi').trigger("change");
    });

    $('#vzdrzevanjeProgramov_programi').change(function() {
        var id = $(this).val();
        var steviloMest;
        $('#vzdrzevanjeProgramov_programi').children().each(function() {
            if ($(this).val() == '') {
                steviloMest = '';
                steviloMestOmejitev = '';
                nacin = '';
                vrsta = '';
                omejitev = '';
            } else if ($(this).val() == id) {
                steviloMest = $(this).attr('data-mesta');
                steviloMestOmejitev = $(this).attr('data-mesta_omejitev');
                nacin = $(this).attr('data-nacin');
                vrsta = $(this).attr('data-vrsta');
                omejitev = $(this).attr('data-omejitev');
            }
        });
        $('#stevilo_vpisnih_mest').val(steviloMest);
        $('#stevilo_mest_omejitev').val(steviloMestOmejitev);

        if (vrsta == '') {
            $('#vrsta_studija').val([]);
        } else if (vrsta == 'Univerzitetni') {
            $('#vrsta_studija').val('un');
        } else {
            $('#vrsta_studija').val('vs');
        }

        if (nacin == '') {
            $('#nacin_studija').val([]);
        } else if (nacin == 'Izredni') {
            $('#nacin_studija').val('izredni');
        } else {
            $('#nacin_studija').val('redni');
        }

        if (omejitev == '') {
            $('#omejitev').val([]);
        }else if (omejitev == 1) {
            $('#omejitev').val("da");
        } else {
            $('#omejitev').val("ne");
        }
    });

    $('#izpisProgramov_fakultete').change(function(){
        var id = $(this).val();

        $('#izpisProgramov_programi').children().each(function() {
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

        $('#izpisProgramov_programi').trigger("change");
    });

    $('#izpisProgramov_programi').change(function() {
        var id = $(this).val();
        var steviloMest;
        $('#izpisProgramov_programi').children().each(function() {
            if ($(this).val() == '') {
                steviloMest = '';
                steviloMestOmejitev = '';
                nacin = '';
                vrsta = '';
                omejitev = -1;
            } else if ($(this).val() == id) {
                steviloMest = $(this).attr('data-mesta');
                steviloMestOmejitev = $(this).attr('data-mesta_omejitev');
                nacin = $(this).attr('data-nacin');
                vrsta = $(this).attr('data-vrsta');
                omejitev = $(this).attr('data-omejitev');
            }
        });
        $('#stevilo_vpisnih_mest').text(steviloMest);
        $('#stevilo_mest_omejitev').text(steviloMestOmejitev);

        $('#vrsta_studija').text(vrsta);
        $('#nacin_studija').text(nacin);
        if (omejitev == 1) {
            $('#omejitev').text("Da");
        } else if (omejitev == 0) {
            $('#omejitev').text("Ne");
        } else {
            $('#omejitev').text("");
        }
    });

});
