@extends('layout.app')

@section('css')
    <style>
        .bgContainer {
            background-image: url("https://www.w3schools.com/w3images/forestbridge.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            position: relative;
            color: white;
            font-family: 'Courier New', Courier, monospace;
        }

        .headerImage {
            position: absolute;
            left: 16px;
        }

        .headerImage h3 {
            margin: 30px 0 0 250px;
        }

        .timeContent {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .soonText {
            font-size: 40px;
        }

        .hrDivide {
            width: 60%;
            margin-top: 10px;
        }
    </style>
@endsection

@section('main-content')
    <div class="bgContainer">
        <div class="headerImage">
            <h3>Dynamic Countdown Timer</h3>
        </div>
        <div class="timeContent">
            <div class="row justify-content-center text-center">
                <h2 class="soonText">COMING SOON</h2>
                <hr class="hrDivide">

                <div class="showTimer" id="jqueryCountdown"
                    data-time="{{ Carbon\Carbon::parse($countdown_timer->launch_date)->format('Y/m/d h:i:s') }}"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>

    <script>
        function countDownFunc() {
            let time = $(".showTimer").data("time");

            $("#jqueryCountdown")
                .countdown(time, function(event) {
                    $(this).html(
                        event.strftime(
                            '<h2>%D Days %H Hrs %M Mins %S Secs</h2>'
                        )
                    );
            });
        }
        window.onload = countDownFunc();
    </script>
@endsection
