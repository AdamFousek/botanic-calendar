<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

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
 * @property int $id
 * @property int $project_id
 * @property string $uuid
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment whereUuid($value)
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment whereUserId($value)
 * @property int|null $setting_id
 * @property-read \App\Models\ExperimentSettings|null $settings
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment whereSettingId($value)
 */
class Experiment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HybridRelations;

    protected $fillable = [
        'name',
        'user_id',
        'color',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users(): Collection|array
    {
        return $this->project->members;
    }

    public function settings(): HasOne
    {
        return $this->hasOne(ExperimentSettings::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (new Carbon($attributes['created_at']))->format('j.n.Y')
        );
    }
}
