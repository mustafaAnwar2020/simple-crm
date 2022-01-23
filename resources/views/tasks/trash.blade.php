@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Deleted tasks</div>

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
                    @foreach ($tasks as $task)
                        <tr>
                            {{-- <td><a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a></td> --}}
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->user->name }}</td>
                            <td>{{ $task->client->company_name }}</td>
                            <td>{{ $task->deadline }}</td>
                            <td @if ($task->status == 'completed')
                                class="btn btn-success"
                            @elseif ($task->status == 'in progress')
                                class="btn btn-secondary"
                            @elseif ($task->status == 'blocked')
                                class="btn btn-danger"
                            @elseif ($task->status == 'canceled')
                                class="btn btn-warning"
                            @elseif ($task->status == 'open')
                                class="btn btn-info"
                            @endif >{{ $task->status }}</td>

                    <td>
                        <a class="btn btn-sm btn-info" href="{{ route('tasks.restore', $task->id) }}">
                            Restore
                        </a>

                        <form action="{{ route('tasks.delete', $task->id) }}" method="POST"
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

            {{ $tasks->withQueryString()->links() }}
        </div>
    </div>

@endsection
