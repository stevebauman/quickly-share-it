@extends('layouts.master')

@section('title', 'Viewing Batch')

@section('content')

    <h2>Batch ID: {{ $batch->name }}</h2>

    <hr>

    <div class="col-md-6">
        {{ $batch->description }}

        <h4>Current Files:</h4>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Upload Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($batch->files as $file)
                    <tr>
                        <td><a href="">{{ $file->name }}</a></td>
                        <td>{{ $file->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-md-6">
        {!!
               Form::open([
                    'id' => 'quickly',
                   'url' => route('upload.perform', [$batch->session_id, $batch->time, $batch->name]),
                   'class' => 'dropzone',
                   'files' => true,
               ])
           !!}

        {!! Form::close() !!}
    </div>

@stop

@section('scripts.bottom')
    <script type="text/javascript">
        Dropzone.options.quickly = {
            init: function () {
                this.on('queuecomplete', function () {
                    location.reload();
                });
            },
            maxFilesize: 500,
            addRemoveLinks: true
        };
    </script>
@stop
