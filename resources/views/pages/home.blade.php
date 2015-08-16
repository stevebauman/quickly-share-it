@extends('layouts.master')

@section('content')

    <div class="jumbotron">
        <div class="container">
            <h2>
                Upload and Share Files, effortlessly.
            </h2>
            <p>
                Looking for a completely anonymous and quick way of sharing files? You've found it.
            </p>
            <p class="text-muted">
                No seriously, we don't even use any visitor analytic tracking (such as Google Analytics).

                We're also completely <a href="https://github.com/stevebauman/quickly-share-it">open source</a>.
            </p>
            <p>
                <a class="btn btn-primary btn-lg" href="{{ route('batch.create') }}" role="button"><i class="fa fa-upload"></i> Upload </a>
            </p>
        </div>
    </div>

@stop
