@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Deleted projects</div>

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
                        <a class="btn btn-sm btn-info" href="{{ route('project.restore', $project->id) }}">
                            Restore
                        </a>

                        <form action="{{ route('project.delete', $project->id) }}" method="POST"
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
