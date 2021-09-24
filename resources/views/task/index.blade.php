@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Task</div>

                    <form id="sortBut" action="{{ route('task.index') }}" method="get">
                        <fieldset>
                            <legend>Sort</legend>
                            <div class="block ">
                                <button type="submit" class="btn btn-secondary" name="sort" value="task_name">Task
                                    name</button>
                                <button type="submit" class="btn btn-secondary" name="sort"
                                    value="status_id">Statuse</button>
                                <button type="submit" class="btn btn-secondary" name="sort" value="completed_data">Completed
                                    data</button>
                            </div>
                            <div class="block">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort_dir" id="_1" value="asc"
                                        @if ('desc' != $sortDirection) checked @endif>
                                    <label class="form-check-label" for="_1">
                                        ASC
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort_dir" id="_2" value="desc"
                                        @if ('desc' == $sortDirection) checked @endif>
                                    <label class="form-check-label" for="_2">
                                        DESC
                                    </label>
                                </div>
                            </div>
                            <div class="block">

                                <a href="{{ route('task.index') }}" class="btn btn-secondary"><i
                                        class="fas fa-redo"></i></a>
                            </div>
                        </fieldset>
                    </form>

                    <form action="{{ route('task.index') }}" method="get">
                        <fieldset>
                            <legend>Filter</legend>
                            <div class="block">
                                <div class="form-group">
                                    <select class="form-control" name="statuse_id">
                                        <option value="0" disabled selected>Select statuse</option>
                                        @foreach ($statuses as $statuse)
                                            <option value="{{ $statuse->id }}" @if ($statuse_id == $statuse->id) selected @endif>
                                                {{ $statuse->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Select statuse from the list.</small>
                                </div>
                            </div>
                            <div class="block">
                                <button type="submit" class="btn btn-secondary" name="filter"
                                    value="statuse">Filter</button>
                                <a href="{{ route('task.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-redo"></i></a>
                            </div>
                        </fieldset>
                    </form>


                    <div class="card-body">
                        <div class="mt-3">{{ $tasks->links() }}</div>
                        <ul class="list-group">
                            @foreach ($tasks as $task)
                                <li class="list-group-item">
                                    <div class="listBlock">
                                        <details>
                                            <summary>{{ $task->task_name }}</summary>
                                            <div class="listBlock__content">
                                                <p><b> Statuse: </b> {{ $task->getStatuse->name }}</p>
                                            </div>

                                            <div class="listBlock__content">
                                                <p><b>Description: </b>{{ $task->task_description }}</p>
                                            </div>

                                            <div class="listBlock__content">
                                                <p><b>Task created: </b>{{ $task->created_at }}</p>
                                            </div>

                                            <div class="listBlock__content">
                                                <p><b>Completed until: </b>{{ $task->completed_data }}</p>
                                            </div>


                                        </details>
                                        <div class="listBlock__buttons">
                                            <a href="{{ route('task.edit', [$task]) }}"
                                                class="btn btn-secondary">Edit</a>
                                            <form method="POST" action="{{ route('task.destroy', $task) }}">
                                                <button class="btn btn-secondary" type="submit"><i
                                                        class="fas fa-trash-alt"></i></button>
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </li>

                            @endforeach
                        </ul>
                        <div class="mt-3">{{ $tasks->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title') Task @endsection
