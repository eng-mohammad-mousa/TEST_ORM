@extends('layouts.app')

@section('content')
{{-- السطر المضاف --}}
{!! NoCaptcha::renderJs() !!}

    <div class="container">

        <link rel="stylesheet" href="{{ asset('login-style.css') }}">
        {{-- <link rel="stylesheet" href="login-style.css"> --}}



        <div class="container" style="height:80vh">

            <form method="POST" class="form-1" action="{{ route('login') }}">
                @csrf

                <h1>Login</h1>
                {{-- مجرد تيست لا اكثر --}}
                {{-- هي رح اعملها انكلود لحقل الايميل --}}
                @include('includes.email-input')
                {{-- هي رح اعملها انكلود لحقل الباسورد --}}
                @include('includes.password-input')


                {{-- خاص بالريكاباتشا --}}
                <div class="conttt">

                    <div class="{{$errors->has('g-recaptcha-response') ? "has-error" : ""}}">
                        {!! NoCaptcha::display() !!}
                    </div>
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            <Strong class="text-danger">هذا الحقل مطلوب يا خرا</Strong>
                            {{-- <strong class="text-danger">{{ $errors->first('g-recaptcha-response') }}</strong> --}}
                        </span>
                    @endif

                </div>


                <div class="conttt">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="conttt">
                    <div>
                        <button type="submit" class="d-block w-100">
                            Login
                        </button>
                        <br>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link text-decoration-none forget-pass mx-auto d-block"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>


            </form>
        </div>

    </div>
@endsection
