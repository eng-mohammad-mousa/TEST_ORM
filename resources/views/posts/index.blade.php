@extends('layouts.app')

@section('content')
    <style>
        .img-cont img {
            max-width: 50px;
            height: 100%;
            object-fit: contain;
        }
    </style>
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

        <div class="card text-dark bg-light mb-2">
            <h1 class="card-header">All Posts</h1>
            <div class="card-body">
                <h5 class="card-title">hello you can see all posts here</h5>
                <a href="{{ route('post.create') }}" class="btn btn-success mt-3">Create Post</a>
                <a href="{{ route('posts.trashed') }}" class="btn btn-danger mt-3">Show Trashed Posts</a>
            </div>
        </div>

        {{--   الرسائل القادمة من الكونترولر كنجاح بلأخضر --}}
        @if ($msg = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show my-3">
                {{ $msg }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{--   الرسائل القادمة من الكونترولر كنجاح بلأحمر --}}
        @if ($msg = Session::get('success-delete'))
            <div class="alert alert-danger alert-dismissible fade show my-3">
                {{ $msg }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @php
            $i = 0;
        @endphp

        {{-- التحقق ان كان هنالك بوستات ام لا --}}
        @if ($posts->count() > 0)
            <table class="table table-hover mt-1">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Created At</th>
                        <th scope="col">User</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td> {{ $item->title }}</td>
                            <td> {{ $item->created_at->diffForhumans() }}</td>
                            {{-- title  تمثل اسم العمود في قاعدة البيانات --}}
                            <td> {{ $item->user->name }}</td>


                            <td class="img-cont">

                                {{-- لم أعرف الفرق بيناتهن --}}
                                <img src="{{ $item->photo }}" alt="">
                                <img src="{{ URL::asset($item->photo) }}" alt="">

                            </td>



                            <td class=" justify-content-between">
                                {{-- نضيف مكتبة الفونت اوسم في app.blade.php --}}


                                <a href="{{ route('post.show', $item->slug) }}"
                                    class="col d-inline-block mx-3  text-success">
                                    <i class="fa-solid fa-eye"></i></a>

                                @if ($item->user_id == Auth::id())
                                    <a href="{{ route('post.edit', $item->id) }}" class="col d-inline-block mx-3">
                                        <i class="fa-solid fa-pen-to-square"></i></a>


                                    <a href="{{ route('post.delete', $item->id) }}"
                                        class="col d-inline-block  mx-3 text-danger">
                                        <i class="fa-solid fa-trash-can"></i></a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-danger alert-dismissible fade show mt-3">
                No post in Database

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


    </div>
@endsection
