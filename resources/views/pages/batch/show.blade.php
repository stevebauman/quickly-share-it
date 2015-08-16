@extends('layouts.master')

@section('title', 'Viewing Batch')

@section('content')

    <h2>{{ $batch->name }}</h2>

    <hr>

    {{ $batch->description }}

    {!!
        Form::open([
            'url' => route('upload.perform', [$batch->session_id, $batch->time, $batch->name]),
            'class' => 'dropzone',
            'files' => true,
        ])
    !!}

    {!! Form::close() !!}

@stop
