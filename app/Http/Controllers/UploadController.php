<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Batch;
use App\Http\Requests\UploadRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadController extends Controller
{
    /**
     * @var Batch
     */
    protected $batch;

    /**
     * Constructor.
     *
     * @param Batch $batch
     */
    public function __construct(Batch $batch)
    {
        $this->batch = $batch;
    }

    /**
     * Uploads files to the specified batch.
     *
     * @param UploadRequest $request
     * @param string $uuid
     */
    public function perform(UploadRequest $request, $uuid)
    {
        // Locate the batch
        $batch = $this->batch->locate($uuid);

        // Retrieve the file from the request
        $file = $request->file('file');

        // Double check the file instance
        if($file instanceof UploadedFile) {

            // Validate file name length
            if(strlen($file->getClientOriginalName()) > 40) {
                abort(422, 'File name is too large');
            }

            // Generate a file name with UUID and its extension
            $name = uuid() . "." . $file->getClientOriginalExtension();

            // Get the storage path
            $path = $batch->uuid . DIRECTORY_SEPARATOR . $name;

            // Move the file into storage
            Storage::put(
                $path,
                file_get_contents($file->getRealPath())
            );

            // Add the file to the batch
            $batch->addFile($file->getClientOriginalName(), $file->getClientMimeType(), $file->getClientSize(), $path);
        } else {
            abort(404);
        }
    }
}
