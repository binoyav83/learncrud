@extends('layouts.default')
@section('content')
<div class="d-flex flex-row-reverse">
    <a class="btn btn-primary mb-2" href="{{ route('users.create')}}">Create new</a> 
</div>
<table class="table table-primary table-striped border">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
    @forelse($users as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->created_at->format('d M Y H:i')}}</td>
        <td><a class="btn btn-primary" href="{{route('users.edit', $user->id)}}">Edit</a>
        <form action="{{route('users.destroy', $user->id)}}" method="post" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
</form>
    </td>
    </tr>
    @empty
    <td>No users</td>
    @endforelse
</table>
<?php echo $users->links(); ?>


@endsection('content')