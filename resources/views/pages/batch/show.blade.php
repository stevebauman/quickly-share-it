@extends('layouts.master')

@section('title', 'Upload Files')

@section('content')

    <h2>Upload Files</h2>

    <hr>

    <div class="col-md-12">
        {!!
           Form::open([
                'id' => 'quickly',
               'url' => route('batch.upload.perform', [$batch->session_id, $batch->time, $batch->name]),
               'class' => 'dropzone',
               'files' => true,
           ])
       !!}

        {!! Form::close() !!}
    </div>

    <h2>Current Files:</h2>

    <hr>

    <div class="row">

        <div class="col-md-12">

            <div class="btn-group" role="group">
                <a href="{{ route('batch.edit', [$batch->session_id, $batch->time, $batch->name]) }}" class="btn btn-default">
                    <i class="fa fa-edit"></i>
                    Edit
                    <span class="hidden-xs">Details</span>
                </a>
                <a href="#" class="btn btn-default" data-toggle="modal" data-target="#lock-modal">
                    <i class="fa fa-lock"></i>
                    Lock
                    <span class="hidden-xs">Folder</span>
                </a>
                <a href="{{ route('batch.download', [$batch->session_id, $batch->time, $batch->name]) }}" class="btn btn-default">
                    <i class="fa fa-download"></i>
                    Download
                    <span class="hidden-xs">All (.Zip)</span>
                </a>
            </div>

        </div>

    </div>

    <div class="row">

        <br>

    </div>

    <div class="row">

        <div class="col-md-12">

            {{ $batch->description }}

            @if($batch->files->count() > 0)

                @foreach($batch->files as $file)

                    <div class="col-md-3">

                        <div class="panel panel-default text-center">

                            <div class="panel-heading">
                                <a href="{{ route('batch.files.show', [$batch->session_id, $batch->time, $batch->name, $file->id]) }}">{{ $file->name }}</a>
                            </div>

                            <div class="panel-body">

                                <span class="pull-left">
                                    <span class="fa-5x">
                                        {!! $file->getIcon() !!}
                                    </span>
                                </span>

                                <span class="pull-right">
                                    <p>
                                        <small class="text-muted">{{ $file->created_at }}</small>
                                    </p>
                                    <p>
                                        {{ $file->getTextualFileSize() }}
                                    </p>
                                </span>

                            </div>

                        </div>

                    </div>

                @endforeach

            @else

                <h4 class="text-muted hidden-xs">There are currently no files inside this folder.</h4>
                <h5 class="text-muted visible-xs">There are current no files inside this folder</h5>

            @endif

        </div>

    </div>

    <!-- Lock Modal -->
    <div class="modal fade" id="lock-modal" tabindex="-1" role="dialog" aria-labelledby="Lock Modal">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h4 class="modal-title" id="lock-modal-label">
                        <i class="fa fa-lock"></i>
                        Lock Folder
                        <small>Prevent changes</small>
                    </h4>

                </div>

                <div class="modal-body">
                    {!!
                        Form::open([
                            'url' => ''
                        ])
                    !!}

                    <div class="form-group">
                        {!! Form::label('Require Password?') !!}
                    </div>

                    <div class="radio">
                        <label>
                            {!! Form::radio('password_required', 'no', false, ['id' => 'field-password-not-required']) !!}

                            No, just lock this folder so no one can make changes.
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            {!! Form::radio('password_required', 'yes', true, ['id' => 'field-password-required']) !!}

                            Yes, I want to set a password for this folder so changes can be made later.
                        </label>
                    </div>

                    <div class="form-group">
                        {!! Form::label('Password') !!}

                        {!! Form::password('password', ['id' => 'field-password', 'class' => 'form-control', 'placeholder' => 'Password']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Confirm Password') !!}

                        {!! Form::password('password_confirmation', ['id' => 'field-password-confirmation', 'class' => 'form-control', 'placeholder' => 'Password Confirmation']) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::label('Require Password to View Folder?') !!}
                    </div>

                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('password_required_view', 'yes', false, ['id' => 'field-password-required-view']) !!}

                            Yes
                        </label>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>

                    {!! Form::close() !!}
                </div>

            </div>

        </div>

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

        if(window.location.href.indexOf('#lock-modal') != -1) {
            $('#lock-modal').modal('show');
        }

        $('#field-password-not-required').click(function() {

        });

        $('#field-password-required').click(function() {

        });
    </script>

@stop
