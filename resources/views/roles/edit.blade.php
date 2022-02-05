@extends('layouts.app')

@section('content')

    <form action="{{ route('roles.update',$role) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">Edit role</div>

            <div class="card-body">
                <div class="form-group">
                    <label class="required" for="title">Name</label>
                    <input class="form-control" type="text" name="name" value="{{$role->name}}" id="title" required>
                    <span class="help-block"> </span>
                </div>
                <div class="form-group">
                    <label for="client_id">Permission</label>
                        @foreach ($permission as $item)
                            <input type="checkbox" name="permission[]" value="{{$item->id}}" {{ in_array($item->id,$rolePermissions) ? 'checked' : '' }}>{{$item->name}}
                        @endforeach
                    <span class="help-block"> </span>
                </div>
                <button class="btn btn-primary" type="submit">
                    Save
                </button>
            </div>
        </div>

    </form>

@endsection
