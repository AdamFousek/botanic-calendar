<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Record extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mongodb';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function experiment()
    {
        return $this->belongsTo(Experiment::class);
    }
}
