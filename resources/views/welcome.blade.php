<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .form-group label{
            border:1px white solid !important;
            cursor: pointer;
            padding: 3px;
        }
        #excelFile{
            display: none;

        }
        .img-excel{
            width: 50px;
            height: 50px;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">

                <div class="container text-center" style="background-color: #107d7e; padding:5px;">
                <div class="row">
                    <div class="col-2">
                    <ul class="navbar-nav ms-auto">

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:white">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    </ul>
                    </div>
            <!--        <div class="col">-->
            <!--    <form action="" method="post" enctype="multipart/form-data">-->
            <!--      @csrf-->
            <!--        <div class="form-group file-get">-->
            <!--            <label for="excelFile" style="color:aliceblue">Выберите Excel-->
            <!--            <img class="img-excel" src="{{asset('/img/logo.png')}}" alt="">-->
            <!--        </label>-->
            <!--            <input id="excelFile" class="form-control-file" type="file" name="excelFile" onchange="javascript:this.form.submit()">-->
            <!--        </div>-->
            <!--    </form>-->
            <!--</div>-->
            <!--<div class="col">sdfdS</div>-->
            </div>
        </div>

        </div>

    <div class="row">
    <table class="table table-hover">
        {{-- <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
          </tr>
        </thead> --}}
        <tbody>
          @if (!empty($datas))
          @foreach ($datas as $dt)

          @foreach ($dt as $row)

          <tr>
            @foreach ($row as $item)
             @if (filter_var($item,FILTER_VALIDATE_URL))
                <td><a href="{{$item}}" >Манзил</a></td>
                @else
                <td>{{$item}}</td>
                @endif
            @endforeach
          </tr>

          @endforeach

        @endforeach
          @else

          @endif

        </tbody>
      </table>
    </div>
    </div>
</body>
</html>
