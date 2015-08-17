@extends('layouts.master')

@section('content')

    <div class="jumbotron">

        <div class="container">
            <h2>
                Upload and Share Files, Effortlessly.
            </h2>
            <p>
                Anonymous, no sign up, and completely free.
            </p>
            <p class="text-muted">
                No seriously, we don't even use any visitor analytic tracking (such as Google Analytics).

                Quickly Share It is also completely <a href="https://github.com/stevebauman/quickly-share-it">open source</a>.
            </p>
            <p class="text-center">
                <a class="btn btn-primary btn-lg" href="{{ route('batch.quick') }}" role="button"><i class="fa fa-upload"></i> Start Uploading </a>
            </p>
        </div>

    </div>

@stop
