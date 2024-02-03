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

        <div class="card text-dark bg-light mb-2">
            <h1 class="card-header">All Users</h1>
            <div class="card-body">
                <h5 class="card-title">hello you can see all users here</h5>
                <a href="{{ route('user.create') }}" class="btn btn-success mt-3">Create Post</a>
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
        @if ($users->count() > 0)
            <table class="table table-hover mt-1">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name User</th>
                        <th scope="col">Email At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td> {{ $item->name }}</td>
                            <td> {{ $item->email }}</td>




                            <td class=" justify-content-between">



                                    {{-- <a href="{{ route('post.edit', $item->id) }}" class="col d-inline-block mx-3">
                                        <i class="fa-solid fa-pen-to-square"></i></a> --}}


                                    <a href="{{ route('user.destroy', $item->id) }}"
                                        class="col d-inline-block  mx-3 text-danger">
                                        <i class="fa-solid fa-trash-can"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-danger alert-dismissible fade show mt-3">
                No Users in Database

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


    </div>
@endsection
