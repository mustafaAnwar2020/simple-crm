@extends('layouts.app')

@section('content')

    <form action="{{ route('projects.update',$project) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">Edit project</div>

            <div class="card-body">
                <div class="form-group">
                    <label class="required" for="title">Title</label>
                    <input class="form-control" type="text" name="title" value="{{$project->title}}" id="title" required>
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="description">Description</label>
                    <textarea class="form-control" rows="10" name="description" id="description">{{$project->description}}</textarea>
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input class="form-control" type="date" name="deadline" value="{{$project->deadline}}" id="deadline">
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label for="user_id">Assigned user</label>
                    <select class="form-control" name="user_id" id="user_id" required>
                        @foreach ($users as $id => $entry)
                            <option value="{{ $id }}" {{ $project->user_id == $id ? 'selected' : '' }}>{{ $entry }}
                            </option>
                        @endforeach
                    </select>

                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label for="client_id">Assigned client</label>
                    <select class="form-control" name="client_id" id="client_id" required>
                        @foreach ($clients as $id => $entry)
                            <option value="{{ $id }}" {{ $project->client_id == $id ? 'selected' : '' }}>{{ $entry }}
                            </option>
                        @endforeach
                    </select>
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status" required>
                        @foreach (App\Models\Project::status as $item)
                            <option value="{{ $item }}" {{ $item == $project->status ? 'selected' : '' }}>{{ $item }}
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
