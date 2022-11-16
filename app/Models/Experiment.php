<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Experiment.
 *
 * @property-read \App\Models\Project|null $project
 * @method static \Database\Factories\ExperimentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment newQuery()
 * @method static \Illuminate\Database\Query\Builder|Experiment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment query()
 * @method static \Illuminate\Database\Query\Builder|Experiment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Experiment withoutTrashed()
 * @mixin \Eloquent
 */
class Experiment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'uuid',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function users(): Collection|array
    {
        return $this->project->users();
    }
}
