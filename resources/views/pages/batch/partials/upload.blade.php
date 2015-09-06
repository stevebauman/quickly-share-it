<h2>Upload Files</h2>

<hr>

<div class="col-md-12">
    {!!
       Form::open([
            'id' => 'quickly',
           'url' => route('batch.upload.perform', [$batch->uuid]),
           'class' => 'dropzone',
           'files' => true,
       ])
   !!}

    {!! Form::close() !!}
</div>

@section('scripts.bottom')

    <script type="text/javascript">
        $(function()
        {
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

            var fieldPassword = $('#field-password');
            var fieldPasswordConfirmation = $('#field-password-confirmation');
            var fieldPasswordRequiredToView = $('#field-password-required-view');

            $('#field-password-not-required').click(function() {
                fieldPassword.attr('disabled', true);
                fieldPasswordConfirmation.attr('disabled', true);
                fieldPasswordRequiredToView.attr('disabled', true);
            });

            $('#field-password-required').click(function() {
                fieldPassword.attr('disabled', false);
                fieldPasswordConfirmation.attr('disabled', false);
                fieldPasswordRequiredToView.attr('disabled', false);

            });
        });
    </script>

@stop
