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
            $builder->whereDate('expiration', '>', date("Y-m-d H:i:s"))
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
