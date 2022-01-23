@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Contact information</div>

    <div class="card-body">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="required" for="first_name">name</label>
                <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="address">Address</label>
                <input class="form-control" type="text" name="address" id="address" value="{{ $user->profile->address }}" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="phone_number">Phone number</label>
                <input class="form-control" type="text" name="phone" id="phone_number" value="{{ $user->profile->phone }}" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="phone_number">Contact</label>
                <input class="form-control" type="text" name="contact" id="phone_number" value="{{ $user->profile->contact }}" required>
                <span class="help-block"> </span>
            </div>

            <button class="btn btn-primary" type="submit">
                Save
            </button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Change password</div>

    <div class="card-body">
        <form action="{{route('profile.changePassword')}}" method="POST">
            @csrf

            <div class="form-group">
                <label class="required" for="old_password">Old password</label>
                <input class="form-control" type="password" name="oldPassword" id="old_password" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="new_password">New password</label>
                <input class="form-control" type="password" name="newPassword" id="new_password" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="new_password_confirmation">Confirm new password</label>
                <input class="form-control " type="password" name="confirmPassword" id="new_password_confirmation" required>
                <span class="help-block"> </span>
            </div>

            <button class="btn btn-primary" type="submit">
                Save
            </button>
        </form>
    </div>
</div>

@endsection
