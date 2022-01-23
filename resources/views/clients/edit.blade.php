@extends('layouts.app')


@section('content')
<div class="card">
    <div class="card-header">Edit Client</div>

    <div class="card-body">
        <form action="{{route('clients.update',$client->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="required" for="contact_name">contact name</label>
                <input class="form-control" type="text" name="contact_name" value="{{$client->contact_name}}" id="contact_name" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="contact_email">contact email</label>
                <input class="form-control" type="text" name="contact_email" value="{{$client->contact_email}}" id="contact_email" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="contact_phone">contact phone</label>
                <input class="form-control " type="text" name="contact_phone" value="{{$client->contact_phone}}" id="contact_address" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="company_name">company name</label>
                <input class="form-control" type="text" name="company_name" value="{{$client->company_name}}" id="contact_name" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="company_email">company adress</label>
                <input class="form-control" type="text" name="company_address" value="{{$client->company_address}}" id="contact_email" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="company_zip">company zip</label>
                <input class="form-control " type="text" name="company_zip" value="{{$client->company_zip}}" id="contact_address" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="company_vat">company vat</label>
                <input class="form-control " type="text" name="company_vat" value="{{$client->company_vat}}" id="contact_address" required>
                <span class="help-block"> </span>
            </div>
            <button class="btn btn-primary" type="submit">
                Save
            </button>
        </form>
    </div>
</div>
@endsection
