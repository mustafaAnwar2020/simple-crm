@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">User info</div>

                <div class="card-body">
                    <p class="mb-0">{{ $user->name }}</p>
                    <p class="mb-0">{{ $user->email }}</p>
                    <p class="mb-0">{{ $user->profile->phone }}</p>
                    <p class="mb-0">{{ $user->profile->address }}</p>
                    <p class="mb-0">{{ $user->profile->contact }}</p>
                    @foreach ($user->getRoleNames() as $item)
                        <p class="mb-0">{{$item}}</p>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Assigned projects</div>
                @foreach ($projects as $item)
                    <div class="card-body">

                        <p class="mb-0">{{ $item->title }}</p>
                        <p class="mb-0">{{ $item->description }}</p>

                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-accent-primary">
                <div class="card-header">Assigned tasks</div>

                @foreach ($tasks as $item)
                    <div class="card-body">

                        <p class="mb-0">{{ $item->title }}</p>
                        <p class="mb-0">{{ $item->description }}</p>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
