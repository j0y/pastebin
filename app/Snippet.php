<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Snippet extends Model
{
    const ACCESS_PUBLIC = 'public';
    const ACCESS_UNLISTED = 'unlisted';
    const ACCESS_PRIVATE = 'private';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('notExpired', function (Builder $builder) {
            $builder->where('expiration', '>', date("Y-m-d H:i:s"))
                    ->orWhereNull('expiration');
        });
    }

    protected $fillable = [
        'title',
        'code',
        'access',
        'syntax',
        'expiration',
        'uuid'
    ];

    static public function accessStates()
    {
        return [
            self::ACCESS_PUBLIC,
            self::ACCESS_UNLISTED,
            self::ACCESS_PRIVATE
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublic($query)
    {
        return $query->where('access', self::ACCESS_PUBLIC);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
