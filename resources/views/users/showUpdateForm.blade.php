<?php

/** @var User $user */

use App\Models\User;

?>


@extends('layouts.main')

@section('title')
    Обновить пользователя
@endsection

@section('content')
    <p><a href="{{ route('users.index') }}">На главную</a></p>

    <h1>Обновить пользователя</h1>

    <form action="{{ route('users.update') }}" method="POST">
        @csrf
        <input type="hidden" value="{{$user->id}}" name="id">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input value="{{$user->name}}" type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Last name</label>
            <input value="{{$user->last_name}}" type="text" class="form-control" id="lastName" name="last_name">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Email</label>
            <input value="{{$user->email}}" type="email" class="form-control" id="email" name="email">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{--<input type="text" name="title" value="{{ old('title') }}">--}}
    {{--@error('title')--}}
    {{--<span class="text-danger">{{ $message }}</span>--}}
    {{--@enderror--}}
@endsection
