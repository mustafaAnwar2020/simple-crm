@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Create User</div>

    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="required" for="first_name">name</label>
                <input class="form-control" type="text" name="name" id="name" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="first_name">email</label>
                <input class="form-control" type="email" name="email" id="name" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="address">Address</label>
                <input class="form-control" type="text" name="address" id="address"  required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="phone_number">Phone number</label>
                <input class="form-control" type="text" name="phone" id="phone_number"  required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="phone_number">Contact</label>
                <input class="form-control" type="text" name="contact" id="phone_number"  required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="new_password">Password</label>
                <input class="form-control" type="password" name="password" id="new_password" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="new_password_confirmation">Confirm Password</label>
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
