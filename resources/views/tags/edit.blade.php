@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('tags') }}" class="my-3 btn btn-primary">
            Go Back To Home
        </a>
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


        <div class="card text-dark bg-light mb-2    ">
            <h1 class="card-header">Edit Tag</h1>
            <div class="card-body">
                <h5 class="card-title">hello you can create post here</h5>

                    <a href="{{route('tags')}}" class="btn btn-success mt-3">Show All Tag</a>
            </div>
        </div>

        <form action="{{ route('tag.update' , $tag->id) }}" method="POST" class="row  g-3 needs-validation" novalidate
            enctype="multipart/form-data">

            {{-- enctype="multipart/form-data" --}}
            {{-- هذه لجعله يسمح برفع صور --}}

            @csrf
            @method('PUT')

            <div class="col-md-12">
                <label for="validationCustom01" class="form-label">Old Tag Name</label>
                <input type="text" class="form-control" value="{{$tag->tags}}" id="validationCustom01" name="tags" required>
                <div class="invalid-feedback">
                    Please Write Tilte Of Your Tag
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
                <button class="btn btn-primary" type="submit">Update Tag</button>
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
