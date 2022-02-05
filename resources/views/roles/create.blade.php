@extends('layouts.app')

@section('content')

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">Create role</div>

            <div class="card-body">
                <div class="form-group">
                    <label class="required" for="title">Name</label>
                    <input class="form-control" type="text" name="name" id="title" required>
                    <span class="help-block"> </span>
                </div>
                <div class="form-group">
                    <label for="client_id">Permission</label>
                        @foreach ($permission as $id => $entry)
                            <input type="checkbox" name="permission[]" value="{{$id}}">{{$entry->name}}
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
