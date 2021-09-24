@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Statuses list</div>
                    <div class="card-body">
                        <div class="mt-3">{{ $statuses->links() }}</div>

                        <ul class="list-group">
                            @foreach ($statuses as $statuse)
                                <li class="list-group-item">
                                    <div class="listBlock">

                                        <h4>{{ $statuse->name }}</h4>

                                        <div class="listBlock__buttons">
                                            <a href="{{ route('statuse.edit', [$statuse]) }}"
                                                class="btn btn-secondary">Edit</a>
                                            <form method="POST" action="{{ route('statuse.destroy', $statuse) }}">
                                                <button class="btn btn-secondary" type="submit"><i
                                                        class="fas fa-trash-alt"></i></button>
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3">{{ $statuses->links() }}</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title') Statuses list @endsection
