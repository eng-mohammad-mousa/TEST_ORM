@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- لمعرفة الايرور الموجودة في صفحتتي --}}
        @if (count($errors) > 0)
            @foreach ($errors->all() as $item)
                <div class="container">
                    <div class="alert alert-danger">
                        {{ $item }}
                    </div>
                </div>
            @endforeach
        @endif

        {{-- الرسائل القادمة من الكونترولر --}}
        @if ($msg = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ $msg }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

         {{-- الرسائل القادمة من الكونترولر --}}
         @if ($msg = Session::get('error'))
         <div class="alert alert-danger alert-dismissible fade show">
             {{ $msg }}

             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
     @endif

        <div class="card text-dark bg-light mb-2    ">
            <h1 class="card-header">Create Tag</h1>
            <div class="card-body">
                <h5 class="card-title">hello you can create tag here</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's
                    content.</p>
                    <a href="{{route('tags')}}" class="btn btn-success mt-3">Show All Tag</a>
            </div>
        </div>

        <form action="{{ route('tag.store') }}" method="POST" class="row  g-3 needs-validation" novalidate >

            @csrf

            <div class="col-md-12">
                <label for="validationCustom01" class="form-label">
                    Tag Name
                </label>
                <input type="text" class="form-control" id="validationCustom01" name="tag" required>
                <div class="invalid-feedback">
                    Please Write Your Tag
                </div>
            </div>


            <div class="col-12">
                <button class="btn btn-primary" type="submit">Save Tag</button>
            </div>
        </form>
    </div>


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
