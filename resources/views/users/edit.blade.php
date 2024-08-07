@extends('layouts.default')
@section('content')

<div>
    <form action="{{route('users.update', $user->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
           @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
            @enderror

        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name', $user->name)}}">
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
         
        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
    </form>

</div>

@endsection('content')