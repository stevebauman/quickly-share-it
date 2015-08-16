<?php

namespace App\Jobs;

use App\Models\Batch;
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
     * Creats a new zip file.
     *
     * @return Zipper
     */
    public function handle()
    {
        $name = (isset($this->batch->name) ? $this->batch->name : $this->generateUniqueName());;

        $zip = $this->zipper->make($name);

        foreach($this->batch->files as $file) {
            $zip->add($file->path);
        }

        return $zip;
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
