@extends('layouts.app')

@section('content')
    {{-- السطر المضاف --}}


    <div class="container">

        <link rel="stylesheet" href="{{ asset('login-style.css') }}">
        {{-- <link rel="stylesheet" href="login-style.css"> --}}

        <div class="container" style="height:80vh">


            <form method="POST" class="form-1"action="{{ route('user.store') }}">
                @csrf

                <h1>Create User</h1>

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




                <div class="conttt">
                    <div>
                        <button type="submit" class="d-block w-100">
                            Create User
                        </button>
                    </div>
                </div>


            </form>
        </div>

    </div>
@endsection
