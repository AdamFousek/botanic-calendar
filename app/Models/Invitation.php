<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Invitation.
 *
 * @property int $id
 * @property int $group_id
 * @property int $user_id
 * @property string $uuid
 * @property int $used
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Group $group
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereUuid($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|Invitation onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Invitation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Invitation withoutTrashed()
 */
class Invitation extends Model
{
    public const INVITATION_EXPIRATION_IN_DAYS = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'group_id',
        'uuid',
        'used',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function isValid()
    {
        return $this->used === 0 &&
            $this->created_at->timestamp > Carbon::now()->subDays(self::INVITATION_EXPIRATION_IN_DAYS)->timestamp;
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
