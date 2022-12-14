<?php

declare(strict_types=1);

namespace App\Models;

use App\Queries\Project\ViewProjectQuery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Project.
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $description
 * @property int $is_public
 * @property int $user_id
 * @property string $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $group_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Group $group
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ProjectFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Query\Builder|Project onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Project withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Project withoutTrashed()
 * @mixin \Eloquent
 * @property-read Collection|\App\Models\Experiment[] $experiments
 * @property-read int|null $experiments_count
 * @method static \Illuminate\Database\Eloquent\Builder|Project orderByQuery(\App\Queries\Project\ViewProjectQuery $query)
 * @property-read Collection|\App\Models\User[] $members
 * @property-read int|null $members_count
 */
class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'uuid',
        'description',
        'is_public',
        'user_id',
        'group_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function members(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, 'project_members', 'project_id', 'user_id')
            ->withTimestamps();
    }

    public function experiments(): HasMany
    {
        return $this->hasMany(Experiment::class);
    }

    public function scopeOrderByQuery(Builder $builder, ViewProjectQuery $query): Builder
    {
        return match ($query->getSort()) {
            ViewProjectQuery::SORT_METHOD_NEWEST => $builder->orderBy('created_at', 'DESC'),
            ViewProjectQuery::SORT_METHOD_ALPHABETIC_ASC => $builder->orderBy('name', 'ASC'),
            ViewProjectQuery::SORT_METHOD_ALPHABETIC_DESC => $builder->orderBy('name', 'DESC'),
        };
    }
}
