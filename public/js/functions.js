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
                omejitev = $(this).attr('data-omejitev');
            }
        });
        $('#stevilo_vpisnih_mest').val(steviloMest);
        $('#stevilo_mest_omejitev').val(steviloMestOmejitev);

        if (vrsta == 'Univerzitetni') {
            $('#vrsta_studija').val('un');
        } else {
            $('#vrsta_studija').val('vs');
        }
        if (nacin == 'Izredni') {
            $('#nacin_studija').val('izredni');
        } else {
            $('#nacin_studija').val('redni');
        }
        if (omejitev == 1) {
            $('#omejitev').val("da");
        } else {
            $('#omejitev').val("ne");
        }
    });

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

    $('#omejitevC').change(function() {
        if ($('#omejitevC').is(":checked"))
            $('.omejitev').show();
        else
            $('.omejitev').hide();
    });

    $('#izvoz').click(function() {

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