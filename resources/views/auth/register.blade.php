@extends('layouts.app')

@section('content')
    {{-- السطر المضاف --}}
    {!! NoCaptcha::renderJs() !!}


    {{-- <div class="container  d-none">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container">

        <link rel="stylesheet" href="{{ asset('login-style.css') }}">
        {{-- <link rel="stylesheet" href="login-style.css"> --}}

        <div class="container" style="height:80vh">


            <form method="POST" class="form-1"action="{{ route('register') }}">
                @csrf

                <h1>Register</h1>

                <div class="conttt">
                    <label for="name">Name</label>

                    <div>
                        <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="conttt">
                    <label for="email">Email</label>

                    <br>

                    <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="conttt">
                    <label for="password">Password</label>
                    <br>
                    <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password"
                        required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>



                <div class="conttt">
                    <label for="password-confirm">Confirm Password</label>
                    <br>
                    <input id="password-confirm" type="password" name="password_confirmation" required
                    autocomplete="new-password"  >
                </div>


                {{-- خاص بالكابتشا --}}
                <div class="conttt">

                    <div class="{{$errors->has('g-recaptcha-response') ? "has-error" : ""}}">
                        {!! NoCaptcha::display() !!}
                    </div>
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif

                </div>

                <div class="conttt">
                    <div>
                        <button type="submit" class="d-block w-100">
                            Register
                        </button>
                    </div>
                </div>


            </form>
        </div>

    </div>
@endsection
