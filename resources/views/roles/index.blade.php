@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('roles.create') }}">
                Create Role
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">roles list</div>

        <div class="card-body">

            <table class="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $item)


                        <tr>
                            <td><a href="{{ route('roles.show', $item) }}">{{ $item->name }}</a></td>

                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('roles.edit', $item) }}">
                                    Edit
                                </a>

                                <form action="{{ route('roles.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $roles->withQueryString()->links() }}
        </div>
    </div>

@endsection
