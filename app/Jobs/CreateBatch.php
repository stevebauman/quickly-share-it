<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Session;
use App\Models\Batch;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateBatch extends Job implements SelfHandling
{
    /**
     * The name of the batch.
     *
     * @var string
     */
    protected $name;

    /**
     * The name of the description.
     *
     * @var string
     */
    protected $description;

    /**
     * The lifetime of the batch.
     *
     * @var int
     */
    protected $lifetime;

    /**
     * Constructor.
     *
     * @param string $name
     * @param string $description
     * @param int    $lifetime
     */
    public function __construct($name = null, $description = null, $lifetime = 1)
    {
        $this->name = (isset($name) ? $name : $this->generateUniqueName());
        $this->description = $description;
        $this->lifetime = $lifetime;
    }

    /**
     * Execute creating a new batch.
     *
     * @return bool|Batch
     */
    public function handle()
    {
        $batch = new Batch();

        $batch->locked = false;
        $batch->session_id = Session::getId();
        $batch->time = time();
        $batch->lifetime = $this->lifetime;
        $batch->description = $this->description;
        $batch->name = $this->name;

        if($batch->save()) {
            return $batch;
        }

        return false;
    }

    /**
     * Generates a random unique string.
     *
     * @return string
     */
    private function generateUniqueName()
    {
        return str_random();
    }
}
