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
                steviloSprejetih= '';
                steviloMestTujci = '';
                steviloMestOmejitevTujci = '';
                steviloSprejetihTujci = '';
                nacin = '';
                vrsta = '';
                omejitev = '';
                omejitevTujci = '';
            } else if ($(this).val() == id) {
                steviloMest = $(this).attr('data-mesta');
                steviloMestOmejitev = $(this).attr('data-mesta_omejitev');
                steviloSprejetih = $(this).attr('data-stevilo_sprejetih');
                steviloMestTujci = $(this).attr('data-mesta_tujci');
                steviloMestOmejitevTujci = $(this).attr('data-mesta_omejitev_tujci');
                steviloSprejetihTujci = $(this).attr('data-stevilo_sprejetih_tujci');
                nacin = $(this).attr('data-nacin');
                vrsta = $(this).attr('data-vrsta');
                omejitev = $(this).attr('data-omejitev');
                omejitevTujci = $(this).attr('data-omejitev_tujci');
            }
        });
        $('#stevilo_vpisnih_mest').val(steviloMest);
        $('#stevilo_mest_omejitev').val(steviloMestOmejitev);
        $('#stevilo_sprejetih').val(steviloSprejetih);
        $('#stevilo_vpisnih_mest_tujci').val(steviloMestTujci);
        $('#stevilo_mest_omejitev_tujci').val(steviloMestOmejitevTujci);
        $('#stevilo_sprejetih_tujci').val(steviloSprejetihTujci);

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

        if (omejitevTujci == '') {
            $('#omejitev_tujci').val([]);
        }else if (omejitevTujci == 1) {
            $('#omejitev_tujci').val("da");
        } else {
            $('#omejitev_tujci').val("ne");
        }
    });

//****************POGOJI

    $('#vzdrzevanjePogojev_fakultete').change(function(){
        var id = $(this).val();
        $('.vpisni_pogoji').hide();
        $('#vzdrzevanjePogojev_programi').children().each(function() {

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

        $('#vzdrzevanjePogojev_programi').trigger("change");
    });

    $('#vzdrzevanjePogojev_programi').change(function() {
        var id = $(this).val();
        if (id > 0) {
            $('.vpisni_pogoji').show();
            $('.vpisni_pogoj').hide();
            $('.program_'+id).show();
        }
    });

    //***********seznam studijskih programov**************

    $('#filtri').change(function() {
        var id = $(this).val();
        if (id == "nacin") {
            var option = $('<option></option>').text("--Izberi--");
            $("#izbira").empty().append(option);
            var option = $('<option></option>').attr("value", "redni").text("Redni");
            $("#izbira").append(option);
            option = $('<option></option>').attr("value", "izredni").text("Izredni");
            $("#izbira").append(option);
        }

        if (id == "vrsta") {
            var option = $('<option></option>').text("--Izberi--");
            $("#izbira").empty().append(option);
            var option = $('<option></option>').attr("value", "vs").text("Visokošolski strokovni");
            $("#izbira").append(option);
            option = $('<option></option>').attr("value", "un").text("Univerzitetni");
            $("#izbira").append(option);
        }

        if (id == "omejitev") {
            var option = $('<option></option>').text("--Izberi--");
            $("#izbira").empty().append(option);
            var option = $('<option></option>').attr("value", "da").text("Da.");
            $("#izbira").append(option);
            option = $('<option></option>').attr("value", "ne").text("Ne.");
            $("#izbira").append(option);
        }
    });

    $('#izbira').change(function() {
        var id_filter = $('#filtri').val();
        var id = $(this).val();
        window.location.href = "/studijskiProgrami/seznam?"+id_filter+"="+id;
    });

    $('#search').keyup(function()
    {
        searchTable($(this).val());
    });

    $('#sifraC').change(function() {
        if ($('#sifraC').is(":checked"))
            $('.sifra').show();
        else
            $('.sifra').hide();
    });

    $('#zavodC').change(function() {
        if ($('#zavodC').is(":checked"))
            $('.zavod').show();
        else
            $('.zavod').hide();
    });

    $('#nacinC').change(function() {
        if ($('#nacinC').is(":checked"))
            $('.nacin').show();
        else
            $('.nacin').hide();
    });

    $('#vrstaC').change(function() {
        if ($('#vrstaC').is(":checked"))
            $('.vrsta').show();
        else
            $('.vrsta').hide();
    });

    $('#steviloC').change(function() {
        if ($('#steviloC').is(":checked"))
            $('.stevilo').show();
        else
            $('.stevilo').hide();
    });

    $('#steviloCO').change(function() {
        if ($('#steviloCO').is(":checked"))
            $('.stevilo_omejitev').show();
        else
            $('.stevilo_omejitev').hide();
    });

    $('#steviloCS').change(function() {
        if ($('#steviloCS').is(":checked"))
            $('.stevilo_sprejetih').show();
        else
            $('.stevilo_sprejetih').hide();
    });

    $('#omejitevC').change(function() {
        if ($('#omejitevC').is(":checked"))
            $('.omejitev').show();
        else
            $('.omejitev').hide();
    });

    $('#steviloCT').change(function() {
        if ($('#steviloCT').is(":checked"))
            $('.steviloT').show();
        else
            $('.steviloT').hide();
    });

    $('#steviloCOT').change(function() {
        if ($('#steviloCOT').is(":checked"))
            $('.stevilo_omejitevT').show();
        else
            $('.stevilo_omejitevT').hide();
    });

    $('#steviloCST').change(function() {
        if ($('#steviloCST').is(":checked"))
            $('.stevilo_sprejetihT').show();
        else
            $('.stevilo_sprejetihT').hide();
    });

    $('#omejitevCT').change(function() {
        if ($('#omejitevCT').is(":checked"))
            $('.omejitevT').show();
        else
            $('.omejitevT').hide();
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
                steviloSprejetih = '';
                steviloMestTujci = '';
                steviloMestOmejitevTujci = '';
                steviloSprejetihTujci = '';
                nacin = '';
                vrsta = '';
                omejitev = -1;
                omejitevTujci = -1;
                $('#gumbIzvozi').attr("disabled", true);
            } else if ($(this).val() == id) {
                steviloMest = $(this).attr('data-mesta');
                steviloMestOmejitev = $(this).attr('data-mesta_omejitev');
                steviloMestTujci = $(this).attr('data-mesta_tujci');
                steviloMestOmejitevTujci = $(this).attr('data-mesta_omejitev_tujci');
                steviloSprejetih = $(this).attr('data-stevilo_sprejetih');
                steviloSprejetihTujci = $(this).attr('data-stevilo_sprejetih_tujci');
                nacin = $(this).attr('data-nacin');
                vrsta = $(this).attr('data-vrsta');
                omejitev = $(this).attr('data-omejitev');
                omejitevTujci = $(this).attr('data-omejitev_tujci');
                $('#gumbIzvozi').attr("disabled", false);
            }
        });
        $('#stevilo_vpisnih_mest').val(steviloMest);
        $('#stevilo_mest_omejitev').val(steviloMestOmejitev);
        $('#stevilo_spr').val(steviloSprejetih);
        $('#stevilo_vpisnih_mest_tujci').val(steviloMestTujci);
        $('#stevilo_mest_omejitev_tujci').val(steviloMestOmejitevTujci);
        $('#stevilo_spr_tujci').val(steviloSprejetihTujci);

        $('#vrsta_studija').val(vrsta);
        $('#nacin_studija').val(nacin);
        if (omejitev == 1) {
            $('#omejitev').val("Da");
        } else if (omejitev == 0) {
            $('#omejitev').val("Ne");
        } else {
            $('#omejitev').val("");
        }
        if (omejitevTujci == 1) {
            $('#omejitev_tujci').val("Da");
        } else if (omejitevTujci == 0) {
            $('#omejitev_tujci').val("Ne");
        } else {
            $('#omejitev_tujci').val("");
        }
    });

    $('#visokosolski_zavod_1').change(function(){
        var id_zavoda = $(this).val();
        var zelja = $('#studijski_program_1');
        if (id_zavoda > 0) {
            zelja.children('.program').hide();
            zelja.children('.zavod_' + id_zavoda).show();
        } else {
            $('#visokosolski_zavod_2').val(0);
            $('#studijski_program_2').val(0);
            $('#visokosolski_zavod_3').val(0);
            $('#studijski_program_3').val(0);
            $('#zelja_2').hide();
            $('#zelja_3').hide();
        }
    });

    $('#visokosolski_zavod_2').change(function(){
        var id_zavoda = $(this).val();
        var zelja = $('#studijski_program_2');
        if (id_zavoda > 0) {
            zelja.children('.program').hide();
            zelja.children('.zavod_' + id_zavoda).show();
        } else {
            $('#visokosolski_zavod_3').val(0);
            $('#studijski_program_3').val(0);
            $('#zelja_3').hide();
        }
    });

    $('#visokosolski_zavod_3').change(function(){
        var id_zavoda = $(this).val();
        var zelja = $('#studijski_program_3');
        if (id_zavoda > 0) {
            zelja.children('.program').hide();
            zelja.children('.zavod_' + id_zavoda).show();
        }
    });
    
    $('#studijski_program_1').change(function () {
       var id_programa = $(this).val();
        if (id_programa > 0) {
            $('#zelja_2').show();
        } else {
            $('#visokosolski_zavod_2').val(0);
            $('#studijski_program_2').val(0);
            $('#visokosolski_zavod_3').val(0);
            $('#studijski_program_3').val(0);
            $('#zelja_2').hide();
            $('#zelja_3').hide();
        }
    });

    $('#studijski_program_2').change(function () {
        var id_programa = $(this).val();
        if (id_programa > 0) {
            $('#zelja_3').show();
        } else {
            $('#visokosolski_zavod_3').val(0);
            $('#studijski_program_3').val(0);
            $('#zelja_3').hide();
        }
    });

    $('#nacin_zakljucka').change(function() {
       var id_nacina_zakljucka = $(this).val();
        if (id_nacina_zakljucka == 3) {
            $('#maturitetni_predmet').show();
        } else {
            $('#maturitetni_predmet').hide();
        }
    });

});

function searchTable(inputVal)
{
    var table = $('#tblData');
    table.find('tr').each(function(index, row)
    {
        var allCells = $(row).find('td');
        if(allCells.length > 0)
        {
            var found = false;
            allCells.each(function(index, td)
            {
                var regExp = new RegExp(inputVal, 'i');
                if(regExp.test($(td).text()))
                {
                    found = true;
                    return false;
                }
            });
            if(found == true)$(row).show();else $(row).hide();
        }
    });
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}



