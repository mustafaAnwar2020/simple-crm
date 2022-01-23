@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Project</div>

                <div class="card-body d-flex justify-content-between">
                    <div>
                        <div class="text-primary">{{ $project->client->contact_name }}</div>
                        <p class="mb-0">{{ $project->client->contact_email }}</p>
                        <p>{{ $project->client->contact_phone }}</p>
                    </div>
                    <div>
                        <p class="mb-0">{{ $project->client->company_name }}</p>
                        <p class="mb-0">{{ $project->client->company_address }}</p>
                        <p class="mb-0">{{ $project->client->company_zip }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Assigned user</div>

                <div class="card-body">
                    <p class="mb-0">{{ $project->user->name }}</p>
                    <p class="mb-0">{{ $project->user->email }}</p>
                    <p class="mb-0">{{ $project->user->profile->phone }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-accent-primary">
                <div class="card-header">{{ $project->title }}</div>

                <div class="card-body">
                    <p>{{ $project->description }}</p>
                </div>

                <div class="card-footer">
                    <p class="mb-0">Created at {{ $project->created_at->format('M d, Y H:m') }}</p>
                    <p class="mb-0">Updated at {{ $project->updated_at->format('M d, Y H:m') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-accent-primary">
                <div class="card-header">Information</div>

                <div class="card-body">
                    <p class="mb-0">Deadline {{ $project->deadline }}</p>
                    <p class="mb-0">Created at {{ $project->created_at->format('M d, Y') }}</p>
                    <p class="mb-0">Status {{ ucfirst($project->status) }}</p>
                </div>
            </div>
        </div>

@endsection
