@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit statuses</div>
                    <div class="card-body">
                        <div class="block__form">
                            <form method="POST" action="{{ route('statuse.update', [$statuse]) }}">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <input class="form-control" type="text" name="statuse_name"
                                        value="{{ old('statuse_name', $statuse->name) }}">
                                </div>
                                @csrf
                                <button type="submit" class="btn btn-secondary">Edit</button>
                            </form>
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

    @section('title') Edit statuses @endsection
