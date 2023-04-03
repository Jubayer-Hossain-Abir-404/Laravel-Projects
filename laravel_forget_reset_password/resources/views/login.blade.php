@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row d-flex justify-content-center my-4">
            @if (Session::has('status'))
                <p class="alert alert-info">{{ Session::get('status') }}</p>
            @endif
            <div class="col-md-6">
                <form action="{{ route('submitLogin') }}" method="post" id="loginForm" enctype="multipart/form-data">
                    <!-- Email input -->
                    @csrf
                    <div class="form-outline mb-4">
                        <input type="email" id="form2Example1" name="login" class="form-control" />
                        <label class="form-label" for="form2Example1">Email</label>
                    </div>

                    @error('login')
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror



                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="form2Example2" name="password" class="form-control" />
                        <label class="form-label" for="form2Example2">Password</label>
                    </div>

                    @error('password')
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" value="1" type="checkbox" name="remember"
                                    value="" id="form2Example31" />
                                <label class="form-check-label" for="form2Example31"> Remember me </label>
                            </div>
                        </div>

                        <div class="col">
                            <!-- Simple link -->
                            <a href="#!">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Submit button -->
                    {{-- <button type="button" class="btn btn-primary btn-block mb-4">Sign in</button> --}}
                    <input type="submit" class="btn btn-primary btn-block mb-4" value="Sign in">

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Not a member? <a href="{{ route('register') }}">Register</a></p>
                        <p>or sign up with:</p>
                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-facebook-f"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-google"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-twitter"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-github"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
@endsection

{{-- @section('script')
    <script>
        $(document).ready(function(event) {
            $('#loginForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "api/login/submit",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        alert(data.message);
                        location.replace("http://127.0.0.1:8000/");
                    },

                    error: function(data) {
                        let errors = data.responseJSON;
                        // clearing error message
                        console.log(errors);
                    }
                })
            });
        })
    </script>
@endsection --}}
