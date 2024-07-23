$(document).ready(function(){

    // $.ajax({
    //     url: "{{route('region-data')}}",
    //     type: "GET",
    //     dataType: "json",
    //     success: function (region) {
    //         $.each(region, function (key, value) {
    //             $("#region").append('<option value="' + value.id + '">' + value.name + "</option>");
    //         });
    //     },
    //     error:function (xhr, ajaxOptions, thrownError){
    //         if(xhr.status==404) {
    //             alert('status:' + xhr.status + ', status text: ' + xhr.statusText);
    //         }
    //     }
    // })

    $('#region').on('change',function(){
        $("#city").html("");
        $.ajax({
            url: "/index-city",
            type: "POST",
            data: {
                region_id: $(this).val(),
            },
            dataType: "json",
            success: function (result) {
                // console.log(result);
                var cityData = JSON.parse(JSON.stringify(result));
                console.log(cityData[0].id);
                $.each(cityData, function (key, value) {
                    $("#city").append('<option value="' + value.id + '">' + value.name + "</option>");
                });
                $("#quarter").html('<option value=""></option>');
            },
            error: (error) => {
                     console.log(JSON.stringify(error));
   }
        });
    });
    $('#city').on('change',function(){
        $("#quarter").html("");
        $.ajax({
            url: "/index-quarter",
            type: "POST",
            data: {
                district_id: $(this).val(),
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

    $('#quarter').on('change',function(){
        $("#street").html("");
        $("#street").append('<option></option>');
        $.ajax({
            url: "/index-street",
            type: "POST",
            data: {
                quarter_id: $(this).val(),
            },
            dataType: "json",
            success: function (result) {
                // console.log(result);
                var streetData = JSON.parse(JSON.stringify(result));
                console.log(streetData[0].id);
                $.each(streetData, function (key, value) {
                    $("#street").append('<option value="' + value.id + '">' + value.name + "</option>");
                });
            },
            error: (error) => {
                console.log(JSON.stringify(error));
            }
        });
    });
    $('#street').on('change',function(){
        $("#numHome").html("");
        $.ajax({
            url: "/index-house",
            type: "POST",
            data: {
                street_id: $(this).val(),
            },
            dataType: "json",
            success: function (result) {
                // console.log(result);
                var houseData = JSON.parse(JSON.stringify(result));
                console.log(houseData[0].id);
                $.each(houseData, function (key, value) {
                    $("#numHome").append('<option value="' + value.home_number + '">' + value.home_number + "</option>");
                });
            },
            error: (error) => {
                console.log(JSON.stringify(error));
            }
        });
    });

    $('#numHome').on('change',function(){
        $.ajax({
            url: "/index-house-location",
            type: "POST",
            data: {
                home_number: $(this).val(),
            },
            dataType: "json",
            success: function (result) {
                // console.log(result);
                var houseData = JSON.parse(JSON.stringify(result));
                console.log(houseData[0].location);
                $(".home-number").empty();
                $(".home-number").append('<a href="' + houseData[0].location + '" class="btn btn-primary"> Geo Location </a>');

            },
            error: (error) => {
                console.log(JSON.stringify(error));
            }
        });
    });
    })
