<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="{{ asset('js/setting.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/setting.css') }}" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Bootstrap Bundle with Popper -->
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</head>
<body>
    <div class="container">
        <div class="row quarter-form">
            <form action="{{route('add-quarter-info')}}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="container-fluid">
                    <h1>Mahalla registratsiyasi</h1>
                    <div class="form-group">
                        <label for="my-input">Login</label>
                        <input id="username" class="form-control" type="text" name="username">
                    </div>
                    <div class="form-group">
                        <label for="my-input">Email</label>
                        <input id="email" class="form-control" type="text" name="email">
                    </div>
                       <div class="mb-3">
                        <label for="" class="form-label">Maxfiy so'z</label>
                <input type="password" class="form-control" name="password" id="password" placeholder=""/>
                         </div>
                         @if (!empty($regions))
                         <div class="row mb-3">
                            <div class="form-group">
                                <label for="region">Viloyatlar</label>

                                <select id="region" class="form-control" name="region">
                                    @foreach ($regions as $region)

                                        <option value="{{$region->id}}">{{$region->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        @endif
                        <div class="row mb-3">
                            <div class="form-group">
                                <label for="city">Shaxar yoki tuman</label>
                                <select id="city" class="form-control" name="city">
                                    <option>Shaharni tanlash</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group">
                                <label for="quarter">Mahalla</label>
                                <select id="quarter" class="form-control" name="quarter">
                                    <option>Mahallani tanlash </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group">
                                <label for="street">Ko'cha</label>
                                <select id="street" class="form-control" name="street">
                                    <option>Ko'chani tanlash </option>
                                </select>
                            </div>
                        </div>
                    <div class="row mb-3">
                        <div class="form-group">
                            <label for="street">Ko'cha</label>
                            <input class="form-control" id="street-input" type="text" placeholder="Ko'chani kiriting" name="street_input">
                        </div>
                    </div>

                        <div class="row mb-3">
                            <label for="file" class="col-md-4 col-form-label text-md-end">{{ __('File') }}</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" required autofocus>

                                @error('file')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                        <button class="btn btn-primary" type="submit">Saqlash</button>


            </form>
        </div>

    </div>
    <script>
        $(document).ready(function(){
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
    $('#quarter').on('change',function(){
        $("#street").html("");
        $("#street").append('<option></option>');
        $.ajax({
            url: "{{route('street-data')}}",
            type: "POST",
            data: {
                quarter_id: $(this).val(),
                _token: '{{csrf_token()}}',
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
    })
    </script>
</body>
</html>
