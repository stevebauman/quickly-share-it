@extends('layouts.master')

@section('title', 'Edit Batch')

@section('content')

    <h2>Edit Folder</h2>

    {!!
        Form::open([
            'url' => route('batch.update', [$batch->uuid]),
            'method' => 'PATCH',
        ])
    !!}

    @include('pages.batch.form')

    {!! Form::close() !!}

@stop
