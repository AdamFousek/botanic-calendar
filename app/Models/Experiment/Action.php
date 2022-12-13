<?php

namespace App\Models\Experiment;

use App\Models\Experiment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'experiment_id',
        'name',
        'fields',
        'notifications',
        'operations',
    ];

    public function subActions(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function action(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function experiment(): BelongsTo
    {
        return $this->belongsTo(Experiment::class);
    }
}
