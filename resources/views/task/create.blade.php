@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New task</div>
                    <div class="card-body">
                        <div class="block__form">
                            <form method="POST" action="{{ route('task.store') }}">
                                <div class="form-group">
                                    <label class="form-label">Task name</label>
                                    <input class="form-control" type="text" name="task_name"
                                        value="{{ old('task_name') }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Complite data</label>
                                    <input class="form-control" type="date" name="task_completed_data"
                                        value="{{ old('task_completed_data') }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Task discription</label>
                                    <textarea id="summernote" name="task_description">
                                                                            {{ old('task_description') }}
                                                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Statuse</label>
                                    <select name="statuse_id">
                                        <option value="0" selected disabled>Select statuse</option>
                                        @foreach ($statuses as $statuse)
                                            <option value="{{ $statuse->id }}" @if (old('statuse_id') == $statuse->id) selected @endif>
                                                {{ $statuse->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @csrf
                                <button type="submit" class="btn btn-secondary">Add</button>
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

@section('title') New task @endsection
