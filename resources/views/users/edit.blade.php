@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Edit User</div>

    <div class="card-body">
        <form action="{{route('users.update',$user)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="required" for="first_name">name</label>
                <input class="form-control" type="text" name="name" value="{{$user->name}}" id="name" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="first_name">email</label>
                <input class="form-control" type="email" name="email" value="{{$user->email}}" id="name" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="address">Address</label>
                <input class="form-control" type="text" name="address" value="{{$user->profile->address}}" id="address"  required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="phone_number">Phone number</label>
                <input class="form-control" type="text" name="phone" value="{{$user->profile->phone}}" id="phone_number"  required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="phone_number">Contact</label>
                <input class="form-control" type="text" name="contact" value="{{$user->profile->contact}}" id="phone_number"  required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label for="client_id">Role</label>
                <select class="form-control" name="role" id="project_id" required>

                    @foreach ($role as $item)
                        <option value="{{ $item->id }}" {{ $userRole == $item->id ? 'selected' : '' }}>{{ $item->name }}
                        </option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>

            <button class="btn btn-primary" type="submit">
                Save
            </button>



        </form>
    </div>
</div>

@endsection
