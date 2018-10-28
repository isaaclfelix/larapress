<?php
$users = App\User::all();
?>
@extends('layouts.dashboard')

@section('panel')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>All Users</h1>
<a href="{{ route('profile') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New User</a>

<table class="table table-striped mt-3">
  <thead>
    <tr>
      <th scope="col"><input type="checkbox" /></th>
      <th scope="col">Username</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Posts</th>
      <th scope="col">Remove</th>
      <th scope="col"><i class="fas fa-sort"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <?php
    // Posts Count
    $role = App\Usermeta::where([
      ['user_id', '=', $user->id],
      ['meta_key', '=', 'role']
    ]);
    if ($role !== null && $role->count()) {
      $role = $role->first();
    }
    else {
      $role = '';
    }

    // Posts Count
    $posts_count = App\Usermeta::where([
      ['user_id', '=', $user->id],
      ['meta_key', '=', 'posts_count']
    ]);
    if ($posts_count !== null && $posts_count->count()) {
      $posts_count = $posts_count->first();
    }
    else {
      $posts_count = '';
    }
    ?>
    <tr>
      <td><input type="checkbox" /></td>
      <td><a href="{{ route('profile', ['user_id' => $user->id]) }}">{{ $user->username }}</a></td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $role }}</td>
      <td>{{ $posts_count }}</td>
      <td>
        <form method="POST" action="{{ route('post') }}">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id" value="{{ $user->id }}">
          <button class="btn btn-primary" type="submit"><i class="fa fa-trash"></i> Remove</button>
        </form>
      </td>
      <td></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
