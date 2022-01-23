@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('projects.create') }}">
                Create project
            </a>
            <a class="btn btn-xs btn-danger" href="{{ route('projects.trash') }}">
                Trash
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Projects list</div>

        <div class="card-body">

            <table class="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Assigned to</th>
                        <th>Client</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            {{-- <td><a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a></td> --}}
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->user->name }}</td>
                            <td>{{ $project->client->company_name }}</td>
                            <td>{{ $project->deadline }}</td>
                            <td @if ($project->status == 'completed')
                                class="btn btn-success"
                            @elseif ($project->status == 'in progress')
                                class="btn btn-secondary"
                            @elseif ($project->status == 'blocked')
                                class="btn btn-danger"
                            @elseif ($project->status == 'canceled')
                                class="btn btn-warning"
                            @elseif ($project->status == 'open')
                                class="btn btn-info"
                            @endif >{{ $project->status }}</td>

                    <td>
                        <a class="btn btn-sm btn-info" href="{{ route('projects.edit', $project) }}">
                            Edit
                        </a>

                        <form action="{{ route('projects.destroy', $project) }}" method="POST"
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

            {{ $projects->withQueryString()->links() }}
        </div>
    </div>

@endsection
