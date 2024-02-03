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




        <div class="card text-dark bg-light mb-2    ">
            <h1 class="card-header">Create Post</h1>
            <div class="card-body">
                <h5 class="card-title">hello you can create post here</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's
                    content.</p>
                <a href="{{ route('posts') }}" class="btn btn-success mt-3">Show All Post</a>
            </div>
        </div>

        <form action="{{ route('posts.store') }}" method="POST" class="row  g-3 needs-validation" novalidate
            enctype="multipart/form-data">

            {{-- enctype="multipart/form-data" --}}
            {{-- هذه لجعله يسمح برفع صور --}}

            @csrf

            <div class="col-md-12">
                <label for="validationCustom01" class="form-label">Tilte</label>
                <input type="text" class="form-control" id="validationCustom01" name="title" required>
                <div class="invalid-feedback">
                    Please Write Tilte Of Your Post
                </div>
            </div>

            {{-- خاص بالعلاقة كثير ل كثير --}}
            <div class="col-md-12">
                @foreach ($tags as $item)
                    {{-- لكي نجعله يسمح بأخد اكثر من خيار نضيف اقواس المصفوفة --}}
                    <input type="checkbox" class="ms-5" id="{{ $item->tags }}" name="tags[]" value="{{ $item->id }}">
                    <label class="me-5" for="{{ $item->tags }}">{{ $item->tags }}</label>
                @endforeach
                <div class="invalid-feedback">
                    Please Select one tag at least
                </div>
            </div>
            {{-- انتهاء الجزء الخاص بالعلاقة كثير ل كثير --}}


            <div class="col-md-12">
                <label for="validationCustom02" class="form-label">Content Of Your Post </label>
                <textarea type="text" class="form-control" id="validationCustom02" style="min-height: 100px" value="Otto"
                    name="content" required></textarea>
                <div class="invalid-feedback">
                    Please Write Your Post Here
                </div>
            </div>
            <div>
                <label for="validationCustom05" class="form-label">Photo Of Post</label>
                <input type="file" class="form-control" id="validationCustom05" name="photo" required>
                <div class="invalid-feedback">
                    Please provide a valid Photo.
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
                <button class="btn btn-primary" type="submit">Save Post</button>
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
