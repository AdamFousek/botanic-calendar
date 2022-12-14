<?php

namespace App\Models\Experiment;

use App\Models\Experiment;
use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

/**
 * App\Models\Experiment\Action.
 *
 * @property int $id
 * @property int $experiment_id
 * @property int|null $parent_id
 * @property string $name
 * @property string|null $fields
 * @property string|null $notifications
 * @property-read Action|null $action
 * @property-read Experiment $experiment
 * @property-read \Illuminate\Database\Eloquent\Collection|Action[] $subActions
 * @property-read int|null $sub_actions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Action newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Action newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Action query()
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereExperimentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereOperations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Action whereParentId($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Record[] $newestRecords
 * @property-read int|null $newest_records_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Record[] $records
 * @property-read int|null $records_count
 * @method static \Jenssegers\Mongodb\Helpers\EloquentBuilder|Action addHybridHas(\Illuminate\Database\Eloquent\Relations\Relation $relation, $operator = '>=', $count = 1, $boolean = 'and', ?\Closure $callback = null)
 * @method static \Illuminate\Database\Query\Builder|Action onlyTrashed()
 * @method static \Jenssegers\Mongodb\Helpers\EloquentBuilder|Action whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Action withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Action withoutTrashed()
 */
class Action extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HybridRelations;

    protected $connection = 'mysql';

    public const TYPE_CALCULATED = 'calculated';

    public const TYPE_TEXT = 'text';

    public const TYPE_NUMBER = 'number';

    public const TYPE_DATETIME = 'datetime';

    public const TYPE_SELECT = 'select';

    public const AVAILABLE_TYPES = [
        self::TYPE_CALCULATED => 'Calculated',
        self::TYPE_TEXT => 'Text',
        self::TYPE_NUMBER => 'Number',
        self::TYPE_DATETIME => 'Date and time',
        self::TYPE_SELECT => 'Select',
    ];

    public const OPERATION_SUBTRACT = 'subtract';

    public const OPERATION_ADD = 'add';

    public const OPERATION_MULTIPLE = 'multiple';

    public const OPERATION_DIVISION = 'division';

    protected $fillable = [
        'parent_id',
        'experiment_id',
        'name',
        'fields',
        'notifications',
    ];

    public $casts = [
        'fields' => 'array',
        'notifications' => 'array',
    ];

    public $timestamps = false;

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

    public function records(): \Jenssegers\Mongodb\Relations\HasMany
    {
        return $this->hasMany(Record::class);
    }

    public function newestRecords(): \Jenssegers\Mongodb\Relations\HasMany
    {
        return $this->hasMany(Record::class)->orderBy('date');
    }

    public function hasCalculated(): bool
    {
        foreach ($this->fields as $field) {
            if ($field['type'] === self::TYPE_CALCULATED) {
                return true;
            }
        }

        return false;
    }
}
