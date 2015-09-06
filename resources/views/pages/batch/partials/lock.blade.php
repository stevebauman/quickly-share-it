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
                        'url' => route('batch.lock', [$batch->uuid])."#lock-modal"
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

                    <span class="label label-danger">{{ $errors->first('password', ':message') }}</span>
                </div>

                <div class="form-group">
                    {!! Form::label('Confirm Password') !!}

                    {!! Form::password('password_confirmation', ['id' => 'field-password-confirmation', 'class' => 'form-control', 'placeholder' => 'Password Confirmation']) !!}

                    <span class="label label-danger">{{ $errors->first('password_confirmation', ':message') }}</span>
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