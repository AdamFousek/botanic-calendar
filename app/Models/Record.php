<?php

namespace App\Models;

use App\Models\Experiment\Action;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Record extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HybridRelations;

    protected $connection = 'mongodb';

    protected $fillable = [
        'date',
        'parent_id',
        'actionId',
        'experimentId',
        'data',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function experiment()
    {
        return $this->belongsTo(Experiment::class);
    }

    public function action()
    {
        return $this->belongsTo(Action::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function records()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
