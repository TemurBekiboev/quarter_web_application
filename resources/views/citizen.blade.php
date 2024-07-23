<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Citizen</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
    <style>
        .registered{
            margin-bottom: 20px;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="container-fluid">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item dropdown" style="width:200px">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="">
                        {{ Auth::user()->login_id }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Sahifadan Chiqish') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <div class="row quarter-form">

            <form action="{{route('update-citizen')}}" method="post">
                @csrf
        <div class="row mb-3">
            <div class="form-group">
                <label for="region">Viloyat</label>
                <select id="region" class="form-control" name="region">
                <option>{{$region[0]->name}}</option>
                </select>
        </div>
        </div>
            <div class="row mb-3">
                <div class="form-group">
                    <label for="region">Shaxar yoki tuman</label>
                    <select id="region" class="form-control" name="district">
                        <option>{{$city[0]->name}}</option>
                    </select>
                </div>
            </div>
                <div class="row mb-3">
                    <div class="form-group">
                        <label for="region">Mahalla</label>
                        <select id="region" class="form-control" name="quarter">
                            <option>{{$quarter[0]->name}}</option>
                        </select>
                    </div>
                </div>
                    <div class="row mb-3">
                        <div class="form-group">
                            <label for="region">Ko'cha</label>
                            <select id="region" class="form-control" name="street">
                                <option>{{$street[0]->name}}</option>
                            </select>
                        </div>
                    </div>
                        <div class="row mb-3">
                            <div class="form-group">
                                <label for="region">Uy raqami</label>
                                <select id="region" class="form-control" name="home_number">
                                    <option>{{$citizen[0]->home_number}}</option>
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group" style="padding: 20px">
                                    <a href="{{$citizen[0]->location}}" class="btn btn-outline-primary"><i class="bi bi-geo-alt-fill">Geo Manzil</i></a>
                                </div>
                            </div>
                        </div>
                @if(empty($citizen[0]->registered))
            <div class="row mb-3">
                <div class="form-group" style="padding: 20px">
                    <label for="house_owner" class="form-label">Xonadon egasi</label>
                    <input type="text" class="form-control" name="house_owner" id="house_owner" placeholder="F.I.O">
                </div>
                <div class="form-group" style="padding: 20px">
                    <label for="registered" class="form-label">Xonadonda ro'yxatda turgan shaxslar</label>
                    <input type="text" class="form-control registered" name="registered[0]" id="registered" placeholder="F.I.O">
                    <div class="row btn-row" style="margin-top: 20px">
                        <div class="col-6"><button class="btn btn-outline-success" id="add-input" type="button">Qator qo'shish</button></div>
                        <div class="col-6"><button class="btn btn-outline-info" id="delete-input" type="button">Qatorni o'chirish</button></div>
                    </div>
            </div>
                <div class="form-group" style="padding: 20px">
                    <button class="btn btn-success" type="submit">Saqlash</button>
                </div>
                @else
                    <div class="row mb-3">

                        <div class="form-group" style="padding: 20px">
                            <label for="house_owner" class="form-label">Xonadon egasi</label>
                            <input type="text" class="form-control" name="house_owner" id="house_owner" value="{{json_decode($citizen[0]->registered)[0]}}" readonly>
                        </div>
                        <div class="form-group" style="padding: 20px">
                            <label for="registered" class="form-label">Xonadonda ro'yxatda turgan shaxslar</label>
                            @for($i=1;$i<count(json_decode($citizen[0]->registered));$i++)
                            <input type="text" class="form-control registered" name="registered[0]" id="registered" value="{{json_decode($citizen[0]->registered)[$i]}}" readonly>
                            @endfor
                        </div>
                    </div>
                @endif


            </form>
        </div>
    </div>
<script type="application/javascript">
    var add_input = document.getElementById('add-input');
    var delete_input = document.getElementById('delete-input');
    var registered = Array();
    registered = document.getElementsByClassName('registered');
    console.log(registered.length);
    add_input.addEventListener('click',function (){
        var new_input = document.createElement('input');
        new_input.classList.add('form-control');
        new_input.classList.add('registered');
        new_input.setAttribute('placeholder','F.I.O');
        new_input.setAttribute('name','registered[' + (registered.length) + ']');
    registered[registered.length-1].after(new_input);
    });
    delete_input.addEventListener('click',function (){
        if(registered.length >1){
        registered[registered.length-1].remove();
        }
    });
</script>
</body>
</html>
