<div class="form-group {{ $errors->first('lifetime', 'has-error') }}">
    {!! Form::label('Lifetime') !!}

    <div class="input-group col-md-4">
        {!!
            Form::select('lifetime',
                [
                    1 => 'One',
                    2 => 'Two',
                    3 => 'Three',
                    4 => 'Four',
                ],
                null,
                [
                   'class' => 'form-control',
                ]
            )
        !!}

        <div class="input-group-addon">Week(s)</div>
    </div>

    <span class="label label-danger">{{ $errors->first('lifetime', ':message') }}</span>

</div>

<div class="form-group {{ $errors->first('name', 'has-error') }}">
    {!! Form::label('Name') !!}

    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'ex. Photos, Files']) !!}

    <span class="label label-danger">{{ $errors->first('name', ':message') }}</span>
</div>

<div class="form-group {{ $errors->first('description', 'has-error') }}">
    {!! Form::label('Description') !!}

    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 10]) !!}

    <span class="label label-danger">{{ $errors->first('description', ':message') }}</span>
</div>

<div class="form-group">
    {!!
        Form::submit('Create', ['class' => 'btn btn-primary'])
    !!}
</div>

