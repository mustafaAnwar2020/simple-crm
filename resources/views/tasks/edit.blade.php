@extends('layouts.app')

@section('content')

    <form action="{{ route('tasks.update',$task) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">Edit task</div>

            <div class="card-body">
                <div class="form-group">
                    <label class="required" for="title">Title</label>
                    <input class="form-control" type="text" name="title" value="{{$task->title}}" id="title" required>
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="description">Description</label>
                    <textarea class="form-control" rows="10" name="description"  id="description">{{$task->description}}</textarea>
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input class="form-control" type="date" name="deadline" value="{{$task->deadline}}" id="deadline">
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label for="user_id">Assigned user</label>
                    <select class="form-control" name="user_id" id="user_id" required>
                        @foreach ($users as $id => $entry)
                            <option value="{{ $id }}" {{ $task->user_id == $id ? 'selected' : '' }}>{{ $entry }}
                            </option>
                        @endforeach
                    </select>

                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label for="client_id">Assigned client</label>
                    <select class="form-control" name="client_id" id="client_id" required>
                        @foreach ($clients as $id => $entry)
                            <option value="{{ $id }}" {{ $task->client_id == $id ? 'selected' : '' }}>{{ $entry }}
                            </option>
                        @endforeach
                    </select>
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label for="client_id">Assigned project</label>
                    <select class="form-control" name="project_id" id="project_id" required>
                        @foreach ($projects as $id => $entry)
                            <option value="{{ $id }}" {{ $task->project_id == $id ? 'selected' : '' }}>{{ $entry }}
                            </option>
                        @endforeach
                    </select>
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status" required>
                        @foreach (App\Models\Task::status as $item)
                            <option value="{{ $item }}" {{ $item == $task->status ? 'selected' : '' }}>{{ $item }}
                            </option>
                        @endforeach
                    </select>

                    <span class="help-block"> </span>
                </div>

                <button class="btn btn-primary" type="submit">
                    Save
                </button>
            </div>
        </div>

    </form>

@endsection
