 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
  <table class="table table-light">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
       <tr>
        <form action="{{route('create-citizen')}}" method="post">
          @csrf
        <td>{{$user->id}}</td>
        <td>
        @foreach ($regions as $region)
            @if ($user->region_id == $region->id)
                {{$region->name}}
            @endif
        @endforeach
        </td>
        <td>
          @foreach ($cities as $city)
            @if ($user->district_id == $city->id)
                {{$city->name}}
            @endif
        @endforeach
        </td>
        <td>
          @foreach ($quarters as $quarter)
          @if ($user->quarter_id == $quarter->id)
              {{$quarter->name}}
          @endif
      @endforeach
        </td>
        <td>
          @foreach ($streets as $street)
          @if ($user->street_id == $street->id)
              {{$street->name}}
          @endif
      @endforeach
        </td>
        <td>
          @foreach ($quarterFiles as $quarterFile)
          @if ($user->street_id == $quarterFile->street_id)
          <input type="hidden" name="file_id" value="{{$quarterFile->id}}">
              @if ($quarterFile->confirmed)
                  confirmed
              @else
              <button class="btn btn-success" type="submit">Yaratish</button>
              @endif
          @endif
      @endforeach
        </td>
      </form>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th>#</th>
      </tr>
    </tfoot>
  </table>
 </body>
 </html>