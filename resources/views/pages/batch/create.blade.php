@extends('layouts.master')

@section('title', 'Create Batch')

@section('content')

    <h2 class="visible-lg visible-md">Create An Upload Batch</h2>

    <h4 class="visible-sm visible-xs">Create An Upload Batch</h4>

    <hr>

    <div class="col-md-6">
        {!!
            Form::open([
                'url' => route('batch.store'),
                'method' => 'POST',
            ])
        !!}

        @include('pages.batch.form')

        {!! Form::close() !!}
    </div>

    <div class="col-md-6">
        <div class="alert alert-info">
            <p>
                An upload batch is just a bucket for storing files. Creating a batch allows you to update the files
                inside without having to creating another.
            </p>

            <p><br></p>

            <p>
                Choose a lifetime for the batch, enter a name / description, and click create. Then start uploading files!
            </p>
        </div>
    </div>
@stop
