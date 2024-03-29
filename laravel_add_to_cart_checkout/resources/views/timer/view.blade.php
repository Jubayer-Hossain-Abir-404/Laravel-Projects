@extends('layouts.app')

@section('css')
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .bgimg {
            background-image: url('https://www.w3schools.com/w3images/forestbridge.jpg');
            height: 100%;
            background-position: center;
            background-size: cover;
            position: relative;
            color: white;
            font-family: "Courier New", Courier, monospace;
            font-size: 25px;
        }

        .topleft {
            position: absolute;
            top: 0;
            left: 16px;
        }

        .middle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        p {
            margin-top: 20px;
            margin-left: 250px;
            margin-bottom: 1rem;
        }

        hr {
            margin: auto;
            width: 40%;
        }
    </style>
@endsection
@section('content')
    <div class="bgimg">
        <div class="topleft">
            <p>Laravel Dynamic Countdown Timer</p>
        </div>
        <div class="middle">
            <h1>COMING SOON</h1>
            <hr>
            <p>
            <div class="wrap-countdown mercado-countdown"
                data-expire="{{ Carbon\Carbon::parse($timer->launch_date)->format('Y/m/d h:i:s') }}"></div>
            </p>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script>
        ;
        (function($) {

            var MERCADO_JS = {
                init: function() {
                    this.mercado_countdown();

                },
                mercado_countdown: function() {
                    if ($(".mercado-countdown").length > 0) {
                        $(".mercado-countdown").each(function(index, el) {
                            var _this = $(this),
                                _expire = _this.data('expire');
                            _this.countdown(_expire, function(event) {
                                $(this).html(event.strftime(
                                    '<span><b>%D</b> Days</span> <span><b>%-H</b> Hrs</span> <span><b>%M</b> Mins</span> <span><b>%S</b> Secs</span>'
                                    ));
                            });
                        });
                    }
                },

            }

            window.onload = function() {
                MERCADO_JS.init();
            }

        })(window.Zepto || window.jQuery, window, document);
    </script>
@endsection
