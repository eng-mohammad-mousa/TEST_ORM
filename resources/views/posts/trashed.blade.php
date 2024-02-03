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
        <a href="{{ route('posts') }}" class="my-3 btn btn-primary">
            Go Back To Home
        </a>

        <div class="card text-dark bg-light mb-3">
            <h1 class="card-header">All Trashed Posts</h1>
            <div class="card-body">
                <h5 class="card-title">hello you can see all Trashed posts here</h5>
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
            <table class="table table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
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
                            {{-- title  تمثل اسم العمود في قاعدة البيانات --}}
                            <td> {{ $item->user->name }}</td>


                            <td class="img-cont">

                                {{-- لم أعرف الفرق بيناتهن --}}
                                <img src="{{ $item->photo }}" alt="">
                                <img src="{{ URL::asset($item->photo) }}" alt="">

                            </td>



                            <td class=" justify-content-between">
                                {{-- نضيف مكتبة الفونت اوسم في app.blade.php --}}
                                <a href="{{ route('post.restore', $item->id) }}"
                                    class="col d-inline-block mx-3 text-success" title="restore">
                                    <i class="fa-solid fa-window-restore"></i></a>


                                <a href="{{ route('post.hardDelete', ['id' => $item->id]) }}"
                                    class="col d-inline-block  mx-3 text-danger" title="force delete">
                                    <i class="fa-solid fa-trash-can"></i></a>

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
