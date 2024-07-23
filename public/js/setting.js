$(document).ready(function(){

    $.ajax({
        url: "{{route('region-data')}}",
        type: "GET",
        dataType: "json",
        success: function (region) {
            $.each(region, function (key, value) {
                $("#region").append('<option value="' + value.id + '">' + value.name + "</option>");
            });
        },
        error:function (xhr, ajaxOptions, thrownError){
            if(xhr.status==404) {
                alert('status:' + xhr.status + ', status text: ' + xhr.statusText);
            }
        }
    })

    $('#region').on('change',function(){
        $("#city").html("");
        $.ajax({
            url: "{{route('city-data')}}",
            type: "POST",
            data: {
                region_id: $(this).val(),
                _token: '{{csrf_token()}}',
            },
            dataType: "json",
            success: function (result) {
                // console.log(result);
                var cityData = JSON.parse(JSON.stringify(result));
                console.log(cityData[0].id);
                $.each(cityData, function (key, value) {
                    $("#city").append('<option value="' + value.id + '">' + value.name + "</option>");
                });
                $("#quarter").html('<option value="">Select State First</option>');
            },
            error: (error) => {
                     console.log(JSON.stringify(error));
   }
        });
    });
    $('#city').on('change',function(){
        $("#quarter").html("");
        $.ajax({
            url: "{{route('quarter-data')}}",
            type: "POST",
            data: {
                district_id: $(this).val(),
                _token: '{{csrf_token()}}',
            },
            dataType: "json",
            success: function (result) {
                // console.log(result);
                var quarterData = JSON.parse(JSON.stringify(result));
                console.log(quarterData[0].id);
                $.each(quarterData, function (key, value) {
                    $("#quarter").append('<option value="' + value.id + '">' + value.name + "</option>");
                });
            },
            error: (error) => {
                     console.log(JSON.stringify(error));
   }
        });
    });
    })
