<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Google Map</title>
</head>
<body onload="getLocation();">
    <form class="myForm" action="{{ route('index.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <label>Input Latitude</label>
        <input type="text" name="latitude" value="">

        <label>Input Longitude</label>
        <input type="text" name="longitude" value="">

        <button type="submit" name="submit">Submit</button>
    </form>

    <div>
        @if ($map!=null)
            @foreach($map as $key)
                <iframe src="https://www.google.com/maps?q={{$key->latitude	}}, {{$key->longitude}}&h1=es;z=14&output=embed"></iframe>
            @endforeach
        @endif
    </div>


    <script src="{{ asset('js/main.js') }}" ></script>
</body>
</html>
