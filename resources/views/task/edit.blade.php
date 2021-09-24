@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit task</div>
                    <div class="card-body">

                        <div class="block__form">
                            <form method="POST" action="{{ route('task.update', [$task]) }}">
                                <div class="form-group">
                                    <label class="form-label">Taks name</label>
                                    <input class="form-control" type="text" name="task_name"
                                        value="{{ old('task_name', $task->task_name) }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Completed data</label>
                                    <div>

                                        <label>Old date: {{ old('task_discription', $task->completed_data) }} </label>
                                    </div>
                                    <input class="form-control" type="datetime-local" name="task_completed_data"
                                        value="{{ old('task_completed_data', $task->completed_data) }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Task discription</label>

                                    <textarea id="summernote" name="task_description">
                                                                                                                        {{ old('task_discription', $task->task_description) }}
                                                                                                </textarea>
                                </div>


                                <div class="form-group">
                                    <label class="form-label">Statuse</label>
                                    <select name="statuse_id">
                                        @foreach ($statuses as $statuse)
                                            <option value="{{ $statuse->id }}" @if (old('statuse_id', $task->statuse_id) == $statuse->id) selected @endif>
                                                {{ $statuse->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @csrf
                                <button type="submit" class="btn btn-secondary">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection

@section('title') Edit task @endsection
