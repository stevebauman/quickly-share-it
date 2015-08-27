<?php

namespace App\Observers;

use App\Models\Upload;

class UploadObserver
{
    /**
     * Delete the file when the model is being deleted.
     *
     * @param Upload $upload
     *
     * @return bool
     */
    public function deleting(Upload $upload)
    {
        // Only allow deletion if the file can be deleted.
        if(unlink($upload->getCompletePath())) {
            return true;
        }

        return false;
    }
}
