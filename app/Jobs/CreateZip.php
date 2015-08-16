<?php

namespace App\Jobs;

use App\Models\Batch;
use App\Models\Upload;
use Chumper\Zipper\Zipper;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateZip extends Job implements SelfHandling
{
    /**
     * The batch to zip.
     *
     * @var Batch
     */
    protected $batch;

    /**
     * The zipper instance.
     *
     * @var Zipper
     */
    protected $zipper;

    /**
     * The zip file extension.
     *
     * @var string
     */
    private $extension = '.zip';

    /**
     * Constructor.
     *
     * @param Batch  $batch
     */
    public function __construct(Batch $batch)
    {
        $this->batch = $batch;
        $this->zipper = new Zipper();
    }

    /**
     * Creates a new zip file and returns the complete file path.
     *
     * @return string
     */
    public function handle()
    {
        if($this->batch->files->count() > 0) {
            $fileName = $this->generateFileName($this->batch->name);

            $zip = $this->zipper->make($fileName);

            foreach($this->batch->files as $file) {
                if($file instanceof Upload) {
                    $zip->add($file->getCompletePath());
                }
            }

            $path = $zip->getFilePath();

            $zip->close();

            return $path;
        }

        return false;
    }

    /**
     * @param null $name
     *
     * @return string
     */
    private function generateFileName($name = null)
    {
        if(!isset($name) || empty($name)) {
            $name = $this->generateUniqueName();
        }

        $path = $this->batch->session_id . DIRECTORY_SEPARATOR . $this->batch->name . DIRECTORY_SEPARATOR;

        return storage_path('app' . DIRECTORY_SEPARATOR .  $path. $name . $this->extension);
    }

    /**
     * Generates a unique zip file name.
     *
     * @return string
     */
    private function generateUniqueName()
    {
        return str_random();
    }
}
