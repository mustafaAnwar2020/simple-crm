@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{route('users.create')}}">
                Create user
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Users list</div>

        <div class="card-body">

            <table class="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)


                        <tr>
                            <td><a href="{{route('users.show',$item)}}">{{$item->name}}</a></td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->profile->phone}}</td>
                            @foreach ($item->getRoleNames() as $role)<td>{{$role}}</td>@endforeach

                    <td>
                        <a class="btn btn-sm btn-info" href="{{route('users.edit',$item)}}">
                            Edit
                        </a>

                        <form action="{{route('users.destroy',$item)}}" method="POST"
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

            {{ $user->withQueryString()->links() }}
        </div>
    </div>

@endsection
