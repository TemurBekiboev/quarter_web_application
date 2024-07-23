@extends('layouts.app')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('./js/quarter_profile.js') }}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    {{-- <script src="{{ asset('js/setting.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">--}}

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/setting.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
{{--    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">--}}

{{--    <!-- Bootstrap Bundle with Popper -->--}}
{{--    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}
</head>
<body>
    <div class="container-fluid">
        <div class="row">
{{--            <div class="col-sm">--}}
{{--            <div class="form-group">--}}
{{--                <label for="sort-home-number"><i class="fa-solid fa-house"></i> Uy raqami bo'yicha filtr</label>--}}
{{--                <select id="sort-home-number" class="form-control" name="sort-home-number">--}}
{{--                    <option><i class="fa-solid fa-house"></i> 1<i class="fa-solid fa-house-user"></i> Temur</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            </div>--}}
            <div class="col-3">
                <div class="form-group">
                    <label for="sort-home-owner"><i class="fa-solid fa-house-user"></i> Xonadon egasi bo'yicha qidiruv</label>

                    <input class="form-control search-citizen" id="search_citizen" type="search" placeholder="Search" aria-label="Search">

                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 50px">


<table class="table table-success table-striped">
    <tr class="header-row">
        <th>Xonadon raqamlari</th>
        <th>Xonadon egasi</th>
        <th>Xonadonda ro'yxatdan o'tgan shaxslar</th>
        <th>Manzil geo nuqtasi</th>
    </tr>
    @foreach($citizens as $citizen)
    <tr>

     <td>
         {{$citizen->home_number}}
     </td>
        <td class="home_owner">
            @if(!empty(json_decode($citizen->registered)))
                {{json_decode($citizen->registered)[0]}}
            @else
                Ro'yxatdan o'tmagan
            @endif
        </td>
        <td>

            @if(!empty(json_decode($citizen->registered)))
                @for($i=1;$i<count(json_decode($citizen->registered));$i++)
                {{json_decode($citizen->registered)[$i]}}
                    <br />
                @endfor
            @else
                Ro'yxatdan o'tmagan
            @endif
        </td>
      <td>
          <a href="{{$citizen->location}}">Manzil</a>
      </td>
    </tr>
    @endforeach
</table>
        </div>
    </div>
</body>

@endsection
