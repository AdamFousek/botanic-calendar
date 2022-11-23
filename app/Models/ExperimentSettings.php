<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ExperimentSettings.
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ExperimentSettingsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperimentSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExperimentSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExperimentSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExperimentSettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperimentSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExperimentSettings whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExperimentSettings extends Model
{
    use HasFactory;
}
