<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    /**
     * The uploads table.
     *
     * @var string
     */
    protected $table = 'uploads';

    /**
     * The fillable upload fields.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path',
    ];
}
