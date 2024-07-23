<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
{{--    <script src="{{ asset('js/setting.js') }}" defer></script>--}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
     <script src="{{ asset('js/setting-index.js') }}" defer></script>

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

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>
<body>
<div class="container-fluid index-body">
    <div class="row">


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
{{--        <a class="navbar-brand" href="#">Navbar</a>--}}
{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
        <div class="container-fluid" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('quarter-profile-info')}}">Mahalla uchun</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('citizen-profile-logged')}}">Aholi uchun</a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#">Pricing</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>

</nav>
    </div>
        <div class="row">
            <div class="col-6">

                <div class="form-group">
                    <label for="region">Viloyat</label>
                    <select id="region" class="form-control region-index" name="region">
                        @foreach(json_decode($regions) as $region)
                                                    <option value="{{$region->id}}">{{$region->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-6">

                <div class="form-group">
                    <label for="city">Shaxar yoki tuman</label>
                    <select id="city" class="form-control city-index" name="district">
                        {{--                            <option>{{$city[0]->name}}</option>--}}
                    </select>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-4">

                <div class="form-group">
                    <label for="quarter">Mahalla</label>
                    <select id="quarter" class="form-control quarter-index" name="quarter">
                        {{--                        <option>{{$quarter[0]->name}}</option>--}}
                    </select>
                </div>

            </div>
            <div class="col-4">

                <div class="form-group">
                    <label for="street">Ko'cha</label>
                    <select id="street" class="form-control street-index" name="street">
                        <option></option>
                        {{--                            <option>{{$street[0]->name}}</option>--}}
                    </select>
                </div>

            </div>
            <div class="col-4">
                <div class="row" style="align-items: flex-end">
                    <div class="col-6">
                <div class="form-group">
                    <label for="numHome">Uy raqami</label>
                    <select id="numHome" class="form-control home-num-index" name="home_number">
                        {{--                            <option>{{$citizen[0]->home_number}}</option>--}}
                    </select>

                </div>
                    </div>
                    <div class="col-6 home-number">



                    </div>
            </div>
            </div>
        </div>

</div>
</body>
</html>
