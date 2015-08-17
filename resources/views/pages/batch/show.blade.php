@extends('layouts.master')

@section('title', 'Upload Files')

@section('content')

    <h2>Upload Files</h2>

    <hr>

    <div class="col-md-12">
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

    <h2>Current Files:</h2>

    <hr>

    <div class="col-md-12">
        {{ $batch->description }}

        <div class="btn-group" role="group">
            <a href="{{ route('batch.edit', [$batch->session_id, $batch->time, $batch->name]) }}" class="btn btn-default">
                <i class="fa fa-edit"></i>
                Edit Details
            </a>
            <a href="" class="btn btn-default"><i class="fa fa-lock"></i> Lock Folder</a>
            <a href="{{ route('batch.download', [$batch->session_id, $batch->time, $batch->name]) }}" class="btn btn-default">
                <i class="fa fa-download"></i>
                Download All (.Zip)
            </a>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Upload Date</th>
                </tr>
            </thead>
            <tbody>
                @if($batch->files->count() > 0)
                    @foreach($batch->files as $file)
                        <tr>
                            <td><a href="">{{ $file->name }}</a></td>
                            <td>{{ $file->created_at }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2">No Files Uploaded Yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
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
            addRemoveLinks: true,
            dictDefaultMessage: "Click or Drop Files Here to Upload"
        };
    </script>
@stop
