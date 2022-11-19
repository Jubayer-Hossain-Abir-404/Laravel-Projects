<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Login/SignUp</title>
    {{-- this file is coming from public --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-white">
    <nav class="p-6 bg-black flex justify-between mb-6">
        <ul class="flex items-center text-white">
            <li>
                <a href="/" class="p-3">Home</a>
            </li>
        </ul>
        <ul class="flex items-center text-white">
                @auth
                    <li>
                        <a href="" class="p-3">{{ auth()->user()->name }}</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post" class="inline">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li>
                        <a href="{{ route('login') }}" class="p-3">Login</a>
                    </li>
                    <li>
                        {{-- this is a a way to use the route register --}}
                        <a href="{{ route('register') }}" class="p-3">Register</a>
                    </li>
                @endguest
        </ul>
    </nav>
    @yield('content')
</body>
</html>