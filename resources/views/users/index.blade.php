@extends('layouts.main')

@section('title')
    Пользователи
@endsection

@section('content')
    <?php
    /** @var array $names */
    /** @var User[] $users */

    use App\Models\User;
    ?>

    <h1>Users Controller</h1>
    <h2>Index</h2>
    <h2><a href="{{ route('users.create') }}">Create a new user</a></h2>

    <a href="{{ route('users.createUsers', ["numberOfUsers" => 5]) }}" target="_blank">Create Users</a>
    {{--<a href="/users/delete-user/10" target="_blank">Delete User with id = 10</a>--}}

    <?php foreach ($users as $key => $user): ?>
    <div>
        <h4>{{ ++$key }}) {{ $user->name }} --- {{ $user->id }} --- <a href="{{ route('users.updateUser', ["id" => $user->id]) }}">Update random User</a></h4>
        <p>{{ $user->email }}------<a href="{{ route('users.deleteUser', ["id" => $user->id]) }}">Delete User</a></p>
        <a class="btn btn-primary" href="{{ route('users.showUpdateForm', ["user" => $user->id]) }}">Update user</a>
        <br><br>
    </div>
    <?php endforeach; ?>
@endsection
