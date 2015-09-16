

    <table class="table table-striped">

        <thead>

            <tr>
                <th>Type</th>
                <th>Name</th>
                <th>Size</th>
                <th>Uploaded</th>
            </tr>

        </thead>

        <tbody>

            @foreach($batch->files as $file)
                <tr>
                    <td class="fa-2">{!! $file->getIcon() !!}</td>
                    <td><a href="{{ route('batch.files.show', [$batch->uuid, $file->uuid]) }}">{{ $file->name }}</a></td>
                    <td>{{ $file->getTextualFileSize() }}</td>
                    <td>{{ $file->created_at }}</td>
                </tr>
            @endforeach

        </tbody>

    </table>