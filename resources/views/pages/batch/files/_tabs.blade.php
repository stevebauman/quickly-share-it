@foreach($batch->files as $file)

    <div class="col-md-4">

        <div class="panel panel-default text-center">

            <div class="panel-heading">
                <a href="{{ route('batch.files.show', [$batch->uuid, $file->uuid]) }}">{{ $file->name }}</a>
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
