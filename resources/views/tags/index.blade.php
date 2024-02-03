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

        <div class="card text-dark bg-light mb-3">
            <h1 class="card-header">All Tags</h1>
            <div class="card-body">
                <h5 class="card-title">hello you can see all Tags here</h5>
                <a href="{{ route('tag.create') }}" class="btn btn-success mt-3">Create Tags</a>

            </div>
        </div>

        {{-- الرسائل القادمة من الكونترولر --}}
        @if ($msg = Session::get('success'))
            <div class="alert alert-danger alert-dismissible fade show my-3">
                {{ $msg }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @php
            $i = 0;
        @endphp

        {{-- التحقق ان كان هنالك بوستات ام لا --}}
        @if ($tags->count() > 0)
            <table class="table table-hover mt-1">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name Tag</th>

                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $item)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td> {{ $item->tags }}</td>


                            <td class=" justify-content-between">
                                {{-- نضيف مكتبة الفونت اوسم في app.blade.php --}}
                                <a href="{{ route('tag.edit', $item->id) }}" class="col d-inline-block mx-3">
                                    <i class="fa-solid fa-pen-to-square"></i></a>



                                <a href="{{ route('tag.destroy', $item->id) }}"
                                    class="col d-inline-block  mx-3 text-danger">
                                    <i class="fa-solid fa-trash-can"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-danger alert-dismissible fade show mt-3">
                No Tags For You in Database

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


    </div>
@endsection
