@extends('layouts.master')

@section('content')

    <div class="text-center">
        <h3>Locked.</h3>

        <p class="text-muted">You must enter the password to view this folder.</p>

        <i class="fa fa-5 fa-lock"></i>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-3"></div>

    <div class="col-md-6">

        {!!
            Form::open([
                'url' => route('batch.gate.unlock', [$batch->uuid]),
                'class' => 'form-horizontal'
            ])
        !!}

        <div class="form-group {{ $errors->first('password', 'has-error') }}">
            <div>
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter the folder Password']) !!}

                <span class="label label-danger">{{ $errors->first('password', ':message') }}</span>
            </div>
        </div>

        <div class="form-group text-center">
            {!! Form::submit('Unlock', ['class' => 'btn btn-lg btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@stop