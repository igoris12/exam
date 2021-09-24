@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New statuse</div>
                    <div class="card-body">
                        <div class="block__form">
                            <form method="POST" action="{{ route('statuse.store') }}">
                                <div class="form-group">
                                    <label class="form-label">Nmae</label>
                                    <input class="form-control" type="text" name="statuse_name"
                                        value="{{ old('statuse_name') }}">
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

@endsection

@section('title') News statuse @endsection
