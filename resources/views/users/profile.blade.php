@extends('layouts.app')

@section('content')
    {{-- لمعرفة الايرور الموجودة في صفحتتي --}}
    @if (count($errors) > 0)
        @foreach ($errors->all() as $item)
            <div class="container">
                <div class="alert alert-danger">
                    {{$item}}
                </div>
            </div>
        @endforeach
    @endif

    <form class="row g-3 needs-validation container m-auto mt-2" novalidate method="POST"
        action="{{ route('profile.update') }}">

        @csrf
        @method('PUT')

        <div class="col-md-8">
            <label for="validationCustom03" class="form-label">Name</label>
            <input type="text" class="form-control" id="validationCustom03" required name="name"
                value="{{ $user->name }}">
            <div class="invalid-feedback">
                Please provide a valid Name.
            </div>
        </div>
        <div class="col-md-8">

            <label for="validationCustomUsername" class="form-label">Facebook</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend"
                    required name="facebook" value="{{ $user->profile->facebook }}">
                <div class="invalid-feedback">
                    Please write your facebook link account.
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <label for="validationCustom03" class="form-label">City</label>
            <input type="text" class="form-control" id="validationCustom03" required name="city"
                placeholder="{{ $user->profile->city }}">
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>

        <div class="col-md-8">
            <label for="validationCustom03" class="form-label">bio</label>
            <input type="text" class="form-control" id="validationCustom03" required name="bio"
                placeholder="{{ $user->profile->bio }}">
            <div class="invalid-feedback">
                Please provide a valid bio.
            </div>
        </div>


        @php
            $genderArray = ['Male', 'Female'];
        @endphp
        <div class="col-md-8">
            <label for="validationCustom04" class="form-label">Gender</label>
            {{-- لا ننسى نكتب نيم للسليكت --}}
            <select class="form-select" id="validationCustom04" required name="gender">
                <option selected disabled value="">Choose...</option>
                @foreach ($genderArray as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Please select a valid state.
            </div>
        </div>

        <br>
        <h2>You Can change password if you wont</h2>
        <div class="col-md-8">
            <label for="validationCustom03" class="form-label">Password</label>
            <input type="text" class="form-control" id="validationCustom03"  name="passwrord">
            <div class="invalid-feedback">
                Please provide a valid Name.
            </div>
        </div>
        <div class="col-md-8">
            <label for="validationCustom03" class="form-label">Confirm Password </label>
            <input type="password" class="form-control" id="validationCustom03"  name="c_passwrord">
            <div class="invalid-feedback">
                Please provide a valid Name.
            </div>
        </div>

        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                    Agree to terms and conditions
                </label>
                <div class="invalid-feedback">
                    You must agree before submitting.
                </div>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-success px-5" type="submit">Save</button>
        </div>
    </form>


    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
