@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('posts') }}" class="my-3 btn btn-primary">
            Go Back To Home
        </a>


        <div class="card text-dark bg-light mb-2    ">

            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ URL::asset($post->photo) }}" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>


                        {{-- خاص بالعلاقة كثير ل كثير --}}
                        <div class="col-md-12">
                            @foreach ($tags as $item)
                                @foreach ($post->tag as $item2)
                                    @if ($item->id == $item2->id)
                                        <label class="me-5" for="{{ $item->tags }}">{{ $item->tags }}</label>
                                    @endif
                                @endforeach
                            @endforeach

                        </div>
                        {{-- انتهاء الجزء الخاص بالعلاقة كثير ل كثير --}}


                        <span>Created at : {{ $post->created_at }}</span>
                        <br>
                        <span>Updated at : {{ $post->updated_at }}</span>

                        <br><br>
                        <span>Created at : {{ $post->created_at->diffForhumans() }}</span>
                        <br>
                        <span>Updated at : {{ $post->updated_at->diffForhumans() }}</span>
                    </div>
                </div>
            </div>



        </div>


    </div>
@endsection
