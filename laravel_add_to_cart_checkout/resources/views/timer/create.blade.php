@extends('layouts.app')

@section('css')
    <style>


        a.btn.btn-lg.btn-block,
        .btn-info {
            color: white !important;
        }

        .btn-secondary {
            background-color: #448BC6 !important;
            color: #fff !important;
        }

        button.btn.btn.btn-secondary {
            width: 100%;
        }

        h3 {
            text-align: center;
            line-height: 200%;
        }

        .collpa .pt-0,
        .py-0 {
            padding-top: 0 !important;
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="main">
                        <h3><a>Countdown Timer Example in Laravel.</a></h3>
                        <form role="form" action="{{ route('timer.update') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Select Date Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="date_time" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="author">Status<span class="text-danger">*</span></label>
                                <select class="form-control" name="timer_status">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn btn-secondary">save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
